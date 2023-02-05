const general = [
    {
        name: 'Home',
        path: '',
        component: () => import("../pages/generals/Home.vue"),
        meta: {
            requiresAuth: true,
            layout: "ArgonLayout"
        }
    },
]

export default general;