import { defineStore } from 'pinia'
import { useAxios } from '@/helpers/axios'

export const usePlayerStore = defineStore({
    id: 'player',
    state: () => ({
        baseUrl: 'players',
        total_player: 0,
        playerWithCards: [],
        meta: {},
        loading: false,
    }),
    getters: {

    },
    actions: {
        async giveCards(data) {
            if (!this.loading) {
                this.loading = true;
                let method = "post";
                let url = this.baseUrl;

                const { res, error } = await useAxios(method, url + "/give-cards", data);
                if (res.value) {
                    this.user = res.value.data.data;
                }
                this.loading = false;
                return { res, error }
            }
        },
    }
})