<template>
    <nav class="sidebar">
        <div class="logo">
            <router-link :to="{ name: 'admin.index' }"  class="flex-start">
                <img class="logo-img" src="/images/logos/logo.svg" alt="Coffee Cup Logo">
                <div class="title">
                    <span class="title-medium">CUP</span>
                    admin
                </div>
            </router-link>
            <i @click="this.$emit('update-show')" class="close-sidebar fa-solid fa-xmark fa-xl"></i>
        </div>

        <ul class="nav-list">
            <li>
                <router-link class="nav-item" :to="{}">
                    <i class="fa-solid fa-user"></i>
                    Пользователи
                </router-link>
            </li>
            <li>
                <router-link class="nav-item" :to="{ name: 'admin.products' }">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Товары
                </router-link>
            </li>
            <li>
                <router-link class="nav-item" :to="{ name: 'admin.categories' }">
                    <i class="fa-solid fa-icons"></i>
                    Категории
                </router-link>
            </li>
            <li>
                <router-link class="nav-item" :to="{}">
                    <i class="fa-solid fa-star"></i>
                    Отзывы
                </router-link>
            </li>
            <li>
                <router-link class="nav-item" :to="{ name: 'user.index' }">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Главная страница
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Sidebar"
}
</script>

<style scoped>
.sidebar {
    z-index: 1000;
    position: fixed;
    height: 100%;
    font-size: 24px;
    display: flex;
    flex-direction: column;
    padding: 30px 10px;
    gap: 35px;
    max-width: 350px;
    background-color: #363636;
}

.logo {
    padding: 0 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.flex-start {
    display: flex;
}

.logo-img {
    filter: drop-shadow(-1px -1px 0px #ffffff) drop-shadow(2px -1px 0px #ffffff) drop-shadow(2px 2px 0px #ffffff) drop-shadow(-1px 2px 0px #ffffff);
}

.close-sidebar {
    color: #fff;
}

.title {
    color: #fff;
}

.nav-list {
    display: flex;
    flex-direction: column;
    gap: 5px;
    color: #fff;
}

.nav-item {
    padding: 10px 25px 10px 15px;
    display: flex;
    gap: 15px;
    border-radius: 10px;
    transition: .1s all;
}

.nav-item:hover {
    background-color: #2d2d2d;
}

</style>
