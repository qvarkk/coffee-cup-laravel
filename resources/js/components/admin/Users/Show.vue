<template>
    <tr>
        <th scope="row">{{ user.id }}</th>
        <td @click="stateStore.setActiveModalId(user.id)">{{ user.email }}</td>
        <td @click="stateStore.setActiveModalId(user.id)">{{ user.name }}</td>
        <td @click="stateStore.setActiveModalId(user.id)">{{ user.role }}</td>
        <td>
            <button @click="openEdit" class="btn-action primary">
                <i class="fa-solid fa-pencil"></i>
            </button>
            <button @click="deleteUser" class="btn-action danger">
                <i class="fa-solid fa-trash"></i>
            </button>
        </td>
    </tr>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";
import {useUserStore} from "@/store/userStore.js";

export default {
    name: "UsersShow",

    setup() {
        const userStore = useUserStore()
        const stateStore = useStateStore()
        return {userStore, stateStore}
    },

    methods: {
        openEdit() {
            this.stateStore.setActiveModalId(this.user.id)
            this.stateStore.startEditing()
        },

        async deleteUser() {
            this.stateStore.startLoading()
            let res = await this.userStore.deleteUser(this.user.id)
            await this.userStore.getUsers()

            if (Math.floor(res.status / 100) !== 2) {
                this.stateStore.showErrorModal(res.response.data.errors)
            }

            this.stateStore.endLoading()
        }
    },

    props: [
        'user'
    ],
}
</script>

<style scoped>
th,
td {
    padding: 15px;
    text-align: left;
    border: 1px solid #dee2e6;
}

thead {
    background-color: #f8f9fa;
}

tbody tr:hover {
    background-color: #f1f1f1;
}
</style>
