import {defineStore} from "pinia";
import {getCurrentUser} from "@/api/users.js";

export const useUserStore = defineStore('auth', {
    state: () => ({
        user: null,
    }),

    actions: {
        async fetchUser() {
            const token = localStorage.getItem('access_token')
            if (token) {
                const res = await getCurrentUser()
                this.user = res.data
            } else {
                this.user = null
            }
        },

        logout() {
            localStorage.removeItem('access_token')
            this.user = null
        }
    }
})
