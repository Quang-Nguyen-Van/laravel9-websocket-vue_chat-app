const admin = [
    {
        path: "/",
        component: () => import("../components/App.vue"),
        children: [
            {
                path: "/admin",
                component: () => import("../layouts/admin.vue"),
                children: [
                    {
                        path: "users",
                        name: "admin-users",
                        component: () =>
                            import("../pages/admin/users/index.vue"),
                    },
                ],
            },
        ],
    },
];

export default admin;

// export const routes = [
//     {
//         name: "Home",
//         path: "/",
//         component: () => import("../components/App.vue"),
//     },
// ];
