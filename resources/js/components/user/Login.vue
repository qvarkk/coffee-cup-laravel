<template>
    <div class="page">
        <h3 class="title">Вход</h3>
        <div class="form-group">
            <label for="email">Почта</label>
            <input v-model="email" id="email" type="email" class="form-input" placeholder="user@example.com"/>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input v-model="password" id="password" type="password" class="form-input" placeholder="********"/>
        </div>
        <span v-if="error" class="error">{{ error }}</span>
        <input class="form-button" @click.prevent="loginUser" type="button" value="ВОЙТИ">
        <span>
            Еще нет аккаунта?
            <router-link class="action-link" :to="{ name: 'user.register' }">Зарегистрироваться</router-link>
        </span>
    </div>
</template>

<script>
import {loginUser} from "@/api/users.js"
import {useUserStore} from "@/store/userStore.js";

export default {
    name: "Login",

    setup() {
        const userStore = useUserStore()
        return {userStore}
    },

    data() {
        return {
            email: null,
            password: null,
            error: null,
        }
    },

    methods: {
        async loginUser() {
            let res = await loginUser(this.email, this.password);
            if (res.status === 200) {
                localStorage.setItem('access_token', res.data.access_token)
                await this.userStore.fetchUser()
                this.$router.push({ name: 'user.index'})
            } else {
                this.error = 'Введена неверная информация для входа'
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

.title {
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

.error {
    margin-bottom: 10px;
    color: #f8405d;
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

@media(max-width: 768px) {
    .page {
        padding: 50px 25px 0;
    }
}
</style>
