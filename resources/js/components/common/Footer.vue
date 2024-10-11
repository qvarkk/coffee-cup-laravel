<template>
    <footer class="footer">
        <div class="container">
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
            <div class="links">
                <span>Подпишитесь на нас</span>
                <div class="link-group">
                    <a href="#">
                        <img src="images/logos/tg.svg" alt="VK Logo">
                    </a>
                    <span class="sm-link">@cupcoffee</span>
                </div>
                <div class="link-group">
                    <a href="#">
                        <img src="images/logos/vk.svg" alt="VK Logo">
                    </a>
                    <span class="sm-link">cupcoffee</span>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style scoped>

.footer {
    padding: 50px 0;
}

.container {
    display: grid;
    grid-template-rows: 1fr;
    grid-template-columns: 2fr 1.5fr 2fr 3fr;
    align-items: center;

    width: 100%;
    max-width: 1060px;
    padding: 0 25px;
    margin: 0 auto;
}

.logo {
    display: flex;
}

.logo > img {
    max-width: 62px;
    max-height: 59px;
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

.nav {
    align-self: start;
}

.nav-list {
    font-size: 16px;
    gap: 12px;
    display: flex;
    flex-direction: column;
    margin: 0;
}

.links {
    align-self: start;
    display: flex;
    gap: 17px;
    flex-direction: column;
}

.link-group {
    display: flex;
    align-items: center;
    gap: 7px;
    font-weight: 400;
}

</style>
