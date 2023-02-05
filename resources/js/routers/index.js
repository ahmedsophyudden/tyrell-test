import { createRouter, createWebHistory } from 'vue-router'
import { createPinia } from 'pinia'
import { useAuthStore } from "@/stores/auth"
import { has } from "lodash";

import auth from './auth';
import general from './general';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...auth,
        ...general
    ]
})

const authStore = useAuthStore(createPinia());

// Vue Router Nagivation Guard
function isLoggedIn() {
    return true;
    // return authStore.isLoggedIn != "null" &&
    //     authStore.isLoggedIn != null
    //     ? true
    //     : false;
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth
        // if not logged in, redirect to login page.
        if (!isLoggedIn()) {
            next({
                name: "Signin"
            });
        } else {
            // const bouncer = store.getters["auth/bouncer"];

            // if (has(to.meta, "permissions") || has(to.meta, "roles")) {
            //     if (typeof to.meta.permissions === "function") {
            //         if (!to.meta.permissions(bouncer, to, from)) {
            //             // Push notification to inform user they do not have permission

            //             // redirect to a universal page they will have access to
            //             next({ name: "Dashboard", replace: true });

            //             return;
            //         }
            //     } else if (
            //         (has(to.meta, "permissions") &&
            //             bouncer.cannot(to.meta.permissions)) ||
            //         (has(to.meta, "roles") && bouncer.isNotA(to.meta.roles))
            //     ) {
            //         // Push notification to inform user they do not have permission

            //         // redirect to a universal page they will have access to
            //         next({ name: "Dashboard", replace: true });

            //         return;
            //     }
            // }

            // they either have permissions or no permissions are required so continue on
            // to the intended route
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route not requires auth, check if logged in
        // if not, redirect to dashboard page.
        if (isLoggedIn()) {
            next({
                name: "Dashboard"
            });
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});

// router.afterEach((to, from) => {
// });

export default router