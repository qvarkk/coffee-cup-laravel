<template>
    <div class="page">
        <h3 class="title">Регистрация</h3>
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
        <input class="form-button" @click.prevent="loginUser" type="button" value="РЕГИСТРАЦИЯ">
        <span>
            Уже есть аккаунт?
            <router-link class="action-link" :to="{ name: 'user.login' }">Войти</router-link>
        </span>
    </div>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            email: null,
            name: null,
            password: null,
            password_confirmation: null,
        }
    },

    methods: {
        async registerUser() {
            let res = await registerUser(this.email, this.name, this.password, this.password_confirmation);
            localStorage.setItem('access_token', res.access_token)
        },

        async getCategories() {
            let res = await get();
            console.log(res);
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
