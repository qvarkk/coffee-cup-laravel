<template>
    <header class="header">
        <div class="line-separator"></div>
        <div class="container">
            <div v-if="user" class="user-side">
                <a href=""><img src="/images/icons/user.svg" alt="User Icon"></a>
                <span>{{ user.email }}</span>
                <a href="" @click.prevent="logoutUser" class="action-link">Выход</a>
            </div>
            <div v-if="!user" class="user-side">
                <a href="#"><img src="/images/icons/user.svg" alt="User Icon"></a>
                <router-link class="action-link" :to="{ name: 'user.login' }">Вход</router-link>
                <router-link class="action-link" :to="{ name: 'user.register' }">Регистрация</router-link>
            </div>
            <div class="nav-side">
                <router-link :to="{ name: 'user.index' }" class="logo">
                    <img src="/images/logos/logo.svg" alt="Coffee Cup Logo">
                    <div class="title">
                        <span class="title-medium">CUP</span>
                        coffee
                    </div>
                </router-link>
                <nav class="nav">
                    <ul class="nav-list">
                        <li class="action-link">Каталог &or;</li>
                        <!-- TODO: use svg for dropdown and add dropdown -->
                        <li class="action-link">Доставка</li>
                        <li class="action-link">Скидки</li>
                        <li class="action-link">Отзывы</li>
                    </ul>
                </nav>
                <div class="user-interaction">
                    <a href="#"><img src="/images/icons/search.svg" alt="Search"></a>
                    <a href="#"><img src="/images/icons/favorites.svg" alt="Favorites"></a>
                    <div style="position: relative">
                        <img src="/images/icons/basket.svg" alt="Cart" style="cursor: pointer" @click="switchCart">
                        <CartModule v-show="showCart" :right="0" />
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import {logoutUser} from "@/api/users.js";
import {useUserStore} from "@/store/authStore.js";
import {useHomepageStateStore} from "@/store/homepageStateStore.js";
import CartModule from "@/components/user/Homepage/CartModule.vue";

export default {
    name: "Header",
    components: {CartModule},

    setup() {
        const stateStore = useHomepageStateStore()
        const userStore = useUserStore()
        return {stateStore, userStore}
    },

    data() {
        return {
            showCart: false,
        }
    },

    computed: {
        user() {
            return this.userStore.user
        }
    },

    methods: {
        async logoutUser() {
            this.stateStore.addNotification('Производится выход...')
            await logoutUser()
            this.userStore.logout()
            this.$router.push({ name: 'user.login' })
        },

        switchCart() {
            if (this.userStore.user)
                this.showCart = !this.showCart
        }
    }
}
</script>

<style scoped>
.header {
    width: 100%;
    background-color: #FFFDF5;
    box-shadow: 0 1px 13px rgba(0, 0, 0, 0.25);
}

.user-side {
    display: flex;
    gap: 20px;
    align-self: end;
    font-size: 16px;
    padding: 23px 0 23px;
    align-items: center;
}

.line-separator {
    position: absolute;
    height: .75px;
    left: 0;
    top: 86px;
    width: 100vw;
    background-color: #B4B4B480;
}

.nav-side {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 13px 0;
}

.nav-list {
    font-size: 16px;
    gap: 40px;
    display: flex;
    margin: 0;
}

.user-interaction {
    font-size: 16px;
    gap: 14px;
    display: flex;
}

</style>
