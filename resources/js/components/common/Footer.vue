<template>
    <footer class="footer">
        <div class="container">
            <div class="logo">
                <img src="/images/logos/logo.svg" alt="Coffee Cup Logo">
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

@media (max-width: 768px) {
    .footer {
        padding-bottom: 25px;
    }

    .container {
        grid-template-rows: 1fr 1fr;
        grid-template-columns: 2fr 1.5fr;
        row-gap: 35px;
        column-gap: 20px;
    }

    .logo {
        justify-self: end;
    }

    .nav {
        justify-self: start;
    }

    .links {
        justify-self: center;
        align-items: center;
        grid-column: 1 / span 2;
    }
}

</style>
