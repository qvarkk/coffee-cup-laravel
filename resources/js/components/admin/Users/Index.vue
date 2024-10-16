<template>
    <div class="container-admin">
        <h3>Пользователи</h3>
        <table class="table">
            <thead>
            <tr>
                <th class="bg-transparent" scope="col">ID</th>
                <th scope="col">Почта</th>
                <th scope="col">Имя</th>
                <th scope="col">Роль</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="user in userStore.users">
                <UsersShow :id="user.id" :user="user"></UsersShow>
                <UsersShowModal v-if="stateStore.activeModalId === user.id" :user="user" :roles="roles"></UsersShowModal>
            </template>
            </tbody>
        </table>
        <div>
            <button @click="stateStore.startCreating()" class="add-btn btn-action primary">
                <i class="fa-solid fa-plus"></i> Добавить
            </button>
        </div>
    </div>
    <UsersCreate :roles="roles"></UsersCreate>
</template>

<script>
import UsersShow from "@/components/admin/Users/Show.vue"
import LoadingSpinner from "@/components/common/LoadingSpinner.vue";
import UsersCreate from "@/components/admin/Users/Create.vue";
import UsersShowModal from "@/components/admin/Users/ShowModal.vue";
import ErrorModal from "@/components/common/ErrorModal.vue";
import {useStateStore} from "@/store/stateStore.js";
import {useUserStore} from "@/store/userStore.js";

export default {
    name: "UsersIndex",

    setup() {
        const userStore = useUserStore()
        const stateStore = useStateStore()
        return {userStore, stateStore}
    },

    data() {
        return {
            roles: null
        }
    },

    components: {
        UsersShow,
        UsersShowModal,
        UsersCreate,
        ErrorModal,
        LoadingSpinner,
    },

    async mounted() {
        this.stateStore.startLoading()
        let roles = await this.userStore.getRoles()
        this.roles = roles.data.data
        await this.userStore.getUsers()
        this.stateStore.endLoading()
    },
}
</script>

<style scoped>
:deep(input) {
    width: 100%;
    border-radius: 0 !important;
    background-color: #fff !important;
    height: 100%;
    padding: 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    padding: 15px;
    text-align: left;
    border: 1px solid #dee2e6;
}

.table thead {
    background-color: #f8f9fa;
}

.add-btn {
    text-transform: none;
    margin: 0 15px;
}
</style>
