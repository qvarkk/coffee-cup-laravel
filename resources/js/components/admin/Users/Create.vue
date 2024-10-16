<template>
    <div class="dialog-overlay" v-if="stateStore.isCreating">
        <div class="dialog">
            <div class="dialog-top">
                <h3>Добавление</h3>
                <i @click="cancelCreating()" class="close-sidebar fa-solid fa-xmark fa-xl"></i>
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
                    <th>Почта</th>
                    <td class="table-input"><input type="email" v-model="email"></td>
                </tr>
                <tr>
                    <th>Имя</th>
                    <td class="table-input"><input type="text" v-model="name"></td>
                </tr>
                <tr>
                    <th>Роль</th>
                    <td class="table-input">
                        <select v-model="role">
                            <option selected disabled>Выберите роль</option>
                            <template v-for="role in roles">
                                <option :value="role.id">{{ role.name }}</option>
                            </template>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="dialog-bottom">
                <button @click="createCategory" class="btn-action primary"
                        :disabled="email === '' || name === '' || !role">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <button @click="cancelCreating()" class="btn-action danger">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";
import {useUserStore} from "@/store/userStore.js";

export default {
    name: "UsersCreate",

    setup() {
        const userStore = useUserStore()
        const stateStore = useStateStore()
        return {userStore, stateStore}
    },

    data() {
        return {
            email: '',
            name: '',
            role: null,
        }
    },

    methods: {
        async createCategory() {
            this.stateStore.startLoading()

            let user = {
                email: this.email,
                name: this.name,
                role: this.role,
            }

            let res = await this.userStore.createUser(user)

            if (Math.floor(res.status / 100) === 2) {
                await this.userStore.getUsers()
                this.stateStore.endCreating()
                this.email = ''
                this.name = ''
                this.role = null
            } else {
                this.stateStore.showErrorModal(res.response.data.errors)
            }

            this.stateStore.endLoading()
        },

        cancelCreating() {
            this.email = ''
            this.name = ''
            this.role = null
            this.stateStore.endCreating()
        }
    },

    props: [
        'roles'
    ]
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
