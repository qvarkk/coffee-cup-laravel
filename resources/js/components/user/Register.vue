<template>
    <div class="page">
        <h3 class="page-title">Регистрация</h3>
        <div class="form-group">
            <label for="email">Почта</label>
            <input v-model="email" id="email" type="email" class="form-input" placeholder="user@example.com"/>
        </div>
        <div class="form-group">
            <label for="name">Имя</label>
            <input v-model="name" id="name" type="text" class="form-input" placeholder="Иванов Иван"/>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input v-model="password" id="password" type="password" class="form-input" placeholder="********"/>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Подтверждение пароля</label>
            <input v-model="password_confirmation" id="password_confirmation" type="password" class="form-input"
                   placeholder="********"/>
        </div>
        <button class="form-button" @click.prevent="registerUser">
            <span v-if="!isLoading">регистрация</span>
            <InlineLoadingSpinner v-if="isLoading" :is-loading="isLoading"></InlineLoadingSpinner>
        </button>
        <span>
            Уже есть аккаунт?
            <router-link class="action-link" :to="{ name: 'user.login' }">Войти</router-link>
        </span>
    </div>
</template>

<script>
import {registerUser} from "@/api/users.js";
import {useHomepageStateStore} from "@/store/homepageStateStore.js";
import {useUserStore} from "@/store/authStore.js";
import InlineLoadingSpinner from "@/components/common/InlineLoadingSpinner.vue";

export default {
    name: "Login",
    components: {InlineLoadingSpinner},

    setup() {
        const stateStore = useHomepageStateStore()
        const userStore = useUserStore()
        return {stateStore, userStore}
    },

    data() {
        return {
            email: null,
            name: null,
            password: null,
            password_confirmation: null,
            isLoading: false,
        }
    },

    methods: {
        async registerUser() {
            this.isLoading = true
            let res = await registerUser(this.email, this.name, this.password, this.password_confirmation)

            if (res.status === 200) {
                this.stateStore.addNotification('Успешно! Входим в систему')
                localStorage.setItem('access_token', res.data.access_token)
                await this.userStore.fetchUser()
                this.$router.push({name: 'user.index'})
            } else {
                for (const [key, err] of Object.entries(res.response.data.errors))
                    this.stateStore.addNotification(err[0])

                this.isLoading = false
            }
        },

        async loginUser() {

        }
    }
}
</script>

<style scoped>
.page {
    padding-top: 50px;
    margin: auto;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}

.page-title {
    margin-bottom: 50px;
}

.form-group {
    display: flex;
    flex-direction: column;
    align-items: start;
    margin-bottom: 20px;
    width: 100%;
}

.form-input {
    margin-top: 10px;
    width: 100%;
}

.form-button {
    width: 75%;
    align-self: center;
    margin-bottom: 20px;
}

.action-link {
    text-decoration: underline;
    font-weight: 600;
}

@media (max-width: 768px) {
    .page {
        padding: 50px 25px 0;
    }
}
</style>
