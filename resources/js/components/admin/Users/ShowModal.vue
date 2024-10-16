<template>
    <div class="dialog-overlay">
        <div class="dialog">
            <UsersEdit v-if="stateStore.isEditing" :user="user" :roles="roles"></UsersEdit>
            <template v-if="!stateStore.isEditing">
                <div class="dialog-top">
                    <h3>Подробности</h3>
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
                        <td>{{ user.id }}</td>
                    </tr>
                    <tr>
                        <th>Почта</th>
                        <td @click="stateStore.startEditing">{{ user.email }}</td>
                    </tr>
                    <tr>
                        <th>Имя</th>
                        <td @click="stateStore.startEditing">{{ user.name }}</td>
                    </tr>
                    <tr>
                        <th>Роль</th>
                        <td @click="stateStore.startEditing">{{ user.role }}</td>
                    </tr>
                    <tr>
                        <th>Почта подтверждена</th>
                        <td @click="stateStore.startEditing">{{ user.email_verified_at ? 'Да' : 'Нет' }}</td>
                    </tr>
                    <tr>
                        <th>Создан</th>
                        <td @click="stateStore.startEditing">{{ formatTimestamp() }}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="dialog-bottom">
                    <button @click="stateStore.startEditing" class="btn-action primary">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <button @click="deleteUser" class="btn-action danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";
import {useUserStore} from "@/store/userStore.js";
import UsersEdit from "@/components/admin/Users/Edit.vue";

export default {
    name: "UsersShowModal",
    components: {UsersEdit},

    setup() {
        const userStore = useUserStore()
        const stateStore = useStateStore()
        return {userStore, stateStore}
    },

    methods: {
        async deleteUser() {
            this.stateStore.closeActiveModal()
            this.stateStore.startLoading()
            await this.userStore.deleteUser(this.id)
            await this.userStore.getUsers()
            this.stateStore.endLoading()
        },

        formatTimestamp() {
            const date = new Date(this.user.created_at);

            return date.getFullYear() + '-' +
                String(date.getMonth() + 1).padStart(2, '0') + '-' +
                String(date.getDate()).padStart(2, '0') + ' ' +
                String(date.getHours()).padStart(2, '0') + ':' +
                String(date.getMinutes()).padStart(2, '0') + ':' +
                String(date.getSeconds()).padStart(2, '0');
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
