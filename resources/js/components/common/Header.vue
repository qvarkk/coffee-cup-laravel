<template>
    <header class="header">
        <div class="line-separator"></div>
        <div class="container">
            <div class="user-side">
                <router-link class="action-link" :to="{ name: 'user.login' }">Вход</router-link>
                <a class="action-link" href="#">Регистрация</a>
            </div>
            <div class="nav-side">
                <div class="logo">
                    <img src="logo.svg" alt="Coffee Cup Logo">
                    <div class="title">
                        <span class="title-medium">CUP</span>
                        coffee
                    </div>
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
                <div class="user-interaction">
                    <div><3</div>
                    <div><3</div>
                    <div><3</div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style scoped>
.header {
    width: 100%;
    background-color: #FFFDF5;
    box-shadow: 0 1px 13px rgba(0, 0, 0, 0.25);
}

.container {
    position: relative;
    display: flex;
    flex-direction: column;

    width: 100%;
    max-width: 1060px;
    padding: 0 25px;
    margin: 0 auto;
}

.user-side {
    display: flex;
    gap: 20px;
    align-self: end;
    font-size: 16px;
    padding: 23px 0 13px;
}

.action-link:hover {
    text-decoration: underline;
}

.line-separator {
    position: absolute;
    height: .75px;
    left: 0;
    top: 60px;
    width: 100vw;
    background-color: #B4B4B480;
}

.nav-side {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 13px 0;
}

.logo {
    display: flex;
}

.title {
    font-size: 20px;
    line-height: 20px;
    margin-left: 7px;
    display: flex;
    flex-direction: column;
    align-self: end;
}

.title-medium {
    font-weight: 600;
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
