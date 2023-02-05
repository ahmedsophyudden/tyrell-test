import { defineStore } from 'pinia'
import { useAxios } from '@/helpers/axios'
import VueCookies from 'vue-cookies'

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => ({
        data: {
            email: "",
            password: ""
        },
        isLoggedIn: VueCookies.get('isLoggedIn'),
        session: null,
        // token: '1|VTYlrm0qowu5EwwKzM24bZsw6W08Qm6yCPWKt6AJ',
        token: '',
    }),
    getters: {

    },
    actions: {
        setIsLoggedIn() {
            VueCookies.set('isLoggedIn', true, 60 * 60 * 24 * 30, '/')
        },

        async signIn() {
            await axios.get('/sanctum/csrf-cookie')
            return await useAxios('post', 'login', this.data);
        },

        async checkSession() {
			return axios.get('/api/userSession').then((response) => {
                this.session = response.data;
                // if (router.currentRoute.name !== null) {
                // 	router.push({ name: 'Dashboard' })
                // };
			}).catch(() => {
				VueCookies.keys().forEach(cookie => VueCookies.remove(cookie, '/'))

                // if (router.currentRoute.name !== 'Signin') {
                // 	window.location.href = "/signin";
                // };
			})
        },
    }
})