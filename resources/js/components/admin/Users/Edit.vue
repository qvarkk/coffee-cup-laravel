<template>
    <div class="dialog-top">
        <h3>Изменение</h3>
        <i @click="stateStore.closeActiveModal()" class="close-sidebar fa-solid fa-xmark fa-xl"></i>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Свойство</th>
            <th>Значение</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ id }}</td>
        </tr>
        <tr>
            <th>Почта</th>
            <td><input type="email" v-model="email"></td>
        </tr>
        <tr>
            <th>Имя</th>
            <td><input type="text" v-model="name"></td>
        </tr>
        <tr>
            <th>Роль</th>
            <td>
                <select v-model="role">
                    <option disabled>Выберите роль</option>
                    <template v-for="role in roles">
                        <option :selected="role.name === user.role" :value="role.id">{{ role.name }}</option>
                    </template>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="dialog-bottom">
        <button @click="updateUser" class="btn-action primary" :disabled="this.name === this.user.name &&
           this.email === this.user.email &&
           this.role.value === this.user.role">
            <i class="fa-solid fa-check fa-xl"></i>
        </button>
        <button @click="this.stateStore.endEditing()" class="btn-action danger">
            <i class="fa-solid fa-xmark fa-xl"></i>
        </button>
    </div>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";
import {useUserStore} from "@/store/userStore.js";

export default {
    name: "UsersEdit",

    data() {
        return {
            id: this.user.id,
            email: this.user.email,
            name: this.user.name,
            role: this.user.role
        }
    },

    setup() {
        const userStore = useUserStore()
        const stateStore = useStateStore()
        return {userStore, stateStore}
    },

    methods: {
        async updateUser() {
            this.stateStore.startLoading()

            let user = {
                id: this.id,
                email: this.email,
                name: this.name,
                role: this.role
            }

            let res = await this.userStore.updateUser(user)

            if (Math.floor(res.status / 100) === 2) {
                await this.userStore.getUsers()
                this.stateStore.closeActiveModal()
            } else {
                this.stateStore.showErrorModal(res.response.data.errors)
            }

            this.stateStore.endLoading()
        }
    },

    props: [
        'user',
        'roles'
    ],
}
</script>

<style scoped>
.dialog h3 {
    margin-top: 0;
    font-size: 1.5rem;
    text-align: center;
}

.dialog td {
    width: 100%;
}

.dialog-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.dialog-bottom {
    display: flex;
    justify-content: end;
    align-items: center;
    margin-top: 15px;
}

.dialog table {
    width: 100%;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

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
