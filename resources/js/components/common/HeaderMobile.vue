<template>
    <header class="header">
        <div class="logo">
            <router-link :to="{ name: 'user.index' }"  class="flex-start">
                <img class="logo-img" src="/images/logos/logo.svg" alt="Coffee Cup Logo">
                <div class="title">
                    <span class="title-medium">CUP</span>
                    admin
                </div>
            </router-link>
            <i @click="this.$emit('update-show')" class="fa-solid fa-xmark fa-xl"></i>
        </div>

        <router-link :to="{ name: 'user.index' }" class="user-email" v-if="user">{{ user.email }}</router-link>

        <div v-if="!user" class="user-side">
            <router-link class="action-link" :to="{ name: 'user.login' }">Вход</router-link>
            <router-link class="action-link" :to="{ name: 'user.register' }">Регистрация</router-link>
        </div>

        <div class="search-box">
            <input class="search-input" type="text" placeholder="Поиск...">
            <a href="#"><img class="search-button" src="/images/icons/search.svg" alt="Search"></a>
        </div>

        <div class="user-interaction">
            <a href="#"><img src="/images/icons/favorites.svg" alt="Favorites"></a>
            <a href="#"><img src="/images/icons/basket.svg" alt="Cart"></a>
        </div>

        <nav class="nav">
            <ul class="nav-list">
                <li class="action-link">Каталог &or;</li>
                <!-- TODO: use svg for dropdown and add dropdown -->
                <li class="action-link">Доставка</li>
                <li class="action-link">Скидки</li>
                <li class="action-link">Отзывы</li>
            </ul>
        </nav>

        <a v-if="user" href="" @click.prevent="logoutUser" class="action-link logout-link">Выход</a>

    </header>
</template>

<script>
import {useUserStore} from "@/store/authStore.js";
import {logoutUser} from "@/api/users.js";

export default {
    name: "HeaderMobile",

    setup() {
        const userStore = useUserStore()
        return {userStore}
    },

    computed: {
        user() {
            return this.userStore.user
        }
    },

    async mounted() {
        await this.userStore.fetchUser()
    },

    methods: {
        async logoutUser() {
            await logoutUser()
            this.userStore.logout()
            this.$router.push({name: 'user.login'})
        }
    }
}
</script>

<style scoped>
.header {
    z-index: 1000;
    position: fixed;
    border-radius: 0 25px 25px 0;
    height: 100%;
    font-size: 24px;
    display: flex;
    flex-direction: column;
    padding: 30px;
    gap: 35px;
    max-width: 300px;
    outline: 2px solid #473E37;
    box-shadow: 0 3px 150px 15px #00000099;
}

.logo {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.flex-start {
    display: flex;
}

.action-link:hover {
    text-decoration: underline;
}

.user-email {
    width: 240px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.user-side {
    display: flex;
    gap: 10px;
}

.search-box {
    display: flex;
    gap: 7px;
}

.search-input {
    padding: 0 15px;
    font-size: 24px;
    width: 75%;
}

.search-button {
    height: 54px;
}

.user-interaction {
    display: flex;
    gap: 15px;
}

.user-interaction > a > img {
    height: 54px;
}

.nav-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.logout-link {
    font-weight: 400;
}

</style>
