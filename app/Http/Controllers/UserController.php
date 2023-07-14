<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as FacadesHash;

class UserController extends Controller
{
    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function index()
    {
        $users = User::join('departments', 'users.department_id', '=', 'departments.id')
        ->join('users_status', 'users.status_id', '=', 'users_status.id')
        ->select('users.*', 'departments.name as department', 'users_status.name as status')
        ->get();

        return response()->json($users);
    }

    public function create()
    {
        $users_status = DB::table('users_status')
            ->select(
                'id as value',
                'name as label',
            )
            ->get();

        $departments = DB::table('departments')
            ->select(
                'id as value',
                'name as label',
            )
            ->get();

        return response()->json([
            'users_status' => $users_status,
            'departments' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        // $validated = $request->validate([
        //         'status_id' => 'required',
        //         'username' => 'required|unique:users,username',
        //         'name' => 'required',
        //         'email' => 'required:email',
        //         'department_id' => 'required',
        //         'password' => 'required|confirmed',
        //     ],
        //     [
        //         'status_id.required' => 'Nhap tinh trang',
        //         'username.required' => 'Nhap Username',
        //         'username.required' => 'Nhap Username',
        //         'name.required' => 'Nhap Ho Ten',
        //         'email.required' => 'Nhap Email',
        //         'email.email' => 'Email khong hop le',
        //         'department_id.required' => 'Nhap Phong Ban',
        //         'password.required' => 'Nhap mat khau',
        //         'password.confirmed' => 'Mat khau khong khop',
        //     ]
        // );

        $user = User::create([
            'status_id' => $request['status_id'],
            'username' => $request['username'],
            'name' => $request['name'],
            'email' => $request['email'],
            'department_id' => $request['department_id'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json($user);
    }

    public function edit(Request $request, $id)
    {
        $users = User::find($id);

        $users_status = DB::table('users_status')
            ->select(
                'id as value',
                'name as label',
            )
            ->get();

        $departments = DB::table('departments')
            ->select(
                'id as value',
                'name as label',
            )
            ->get();

        return response()->json([
            'users' => $users,
            'users_status' => $users_status,
            'departments' => $departments,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
                'status_id' => 'required',
                'username' => 'required|unique:users,username,'.$id,
                'name' => 'required',
                'email' => 'required:email',
                'department_id' => 'required',
            ],
            [
                'status_id.required' => 'Nhap tinh trang',
                'username.required' => 'Nhap Username',
                'username.required' => 'Nhap Username',
                'name.required' => 'Nhap Ho Ten',
                'email.required' => 'Nhap Email',
                'email.email' => 'Email khong hop le',
                'department_id.required' => 'Nhap Phong Ban',
            ]
        );

        User::find($id)->update([
            'status_id' => $request['status_id'],
            'username' => $request['username'],
            'name' => $request['name'],
            'email' => $request['email'],
            'department_id' => $request['department_id'],
        ]);

        if($request['change_password'] == true){
            $validated = $request->validate([
                    'password' => 'required|confirmed',
                ],
                [
                    'password.required' => 'Nhap mat khau',
                    'password.confirmed' => 'Mat khau khong khop',
                ]
            );

            User::find($id)->update([
                'password' => Hash::make($request['password']),
                'change_password_at' => NOW(),
            ]);
        }
    }

}
