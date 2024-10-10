<template>
    <div>
        <h3>Вход</h3>
        <div>
            <label for="email">Почта</label>
            <input v-model="email" id="email" type="email" placeholder="user@example.com" />
        </div>
        <div>
            <label for="password">Пароль</label>
            <input v-model="password" id="password" type="password" placeholder="********" />
        </div>
        <input @click.prevent="loginUser" type="button" value="ВОЙТИ">
        <input @click.prevent="getCategories" type="button" value="тест категорий">
    </div>
</template>

<script>
import {loginUser} from "@/api/users.js"
import {get} from "@/api/categories.js"

export default {
    name: "Login",

    data() {
        return {
            email: null,
            password: null,
        }
    },

    methods: {
        async loginUser() {
            let res = await loginUser(this.email, this.password);
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

</style>
