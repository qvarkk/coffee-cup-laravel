<template>
    <div class="page">
        <h3 class="page-title">Вход</h3>
        <div class="form-group">
            <label for="email">Почта</label>
            <input v-model="email" id="email" type="email" class="form-input" placeholder="user@example.com"/>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input v-model="password" id="password" type="password" class="form-input" placeholder="********"/>
        </div>
        <button class="form-button" @click.prevent="loginUser">
            <span v-if="!isLoading">войти</span>
            <InlineLoadingSpinner v-if="isLoading" :is-loading="isLoading"></InlineLoadingSpinner>
        </button>
        <span>
            Еще нет аккаунта?
            <router-link class="action-link" :to="{ name: 'user.register' }">Зарегистрироваться</router-link>
        </span>
    </div>
</template>

<script>
import {loginUser} from "@/api/users.js"
import {useUserStore} from "@/store/authStore.js";
import InlineLoadingSpinner from "@/components/common/InlineLoadingSpinner.vue";
import {useHomepageStateStore} from "@/store/homepageStateStore.js";

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
            password: null,
            isLoading: false,
        }
    },

    methods: {
        async loginUser() {
            this.isLoading = true
            let res = await loginUser(this.email, this.password);
            if (res.status === 200) {
                this.stateStore.addNotification('Успешно! Входим в систему')
                localStorage.setItem('access_token', res.data.access_token)
                await this.userStore.fetchUser()
                this.$router.push({name: 'user.index'})
            } else {
                this.stateStore.addNotification('Введена неверная информация для входа')
                this.isLoading = false
            }
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
    width: 50%;
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
