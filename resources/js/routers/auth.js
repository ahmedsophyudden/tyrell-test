const auth = [
    {
        name: "Signin",
        path: "/signin",
        component: () => import("../pages/auths/Signin.vue"),
        meta: {
            requiresVisitor: true,
            layout: "ArgonLayout"
        }
    },
]

export default auth;