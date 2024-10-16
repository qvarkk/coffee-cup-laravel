import {defineStore} from "pinia";
import {createUser, deleteUser, getRoles, getUsers, updateUser} from "@/api/users.js";

export const useUserStore = defineStore('users', {
    state: () => ({
        users: null,
    }),

    actions: {
        async getRoles() {
            return await getRoles()
        },

        async getUsers() {
            let res = await getUsers()
            this.users = res.data.data
            return res
        },

        async createUser(user) {
            return await createUser(user)
        },

        async updateUser(user) {
            return await updateUser(user)
        },

        async deleteUser(id) {
            return await deleteUser(id)
        }
    }
})
