<template>
    <div class="banner">
        <div class="bg-image"></div>
        <div class="fg-items">
            <h3 class="banner-heading">
                БЕСПЛАТНАЯ ДОСТАВКА КОФЕ ПО ВСЕЙ РОССИИ
            </h3>
            <span class="banner-promo">
            Каждый день мы обжариваем кофе, чтобы порадовать вас вкусными напитками
        </span>
            <div class="banner-button-group">
                <button class="banner-button"><i class="fa-solid fa-mug-hot"></i> Популярное</button>
                <button class="banner-button"><i class="fa-solid fa-percent"></i> Скидки</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Banner"
}
</script>

<style scoped>
.banner {
    position: relative;
    height: clamp(500px, calc(100vw / 1.5), 685px);
    width: 100%;
    color: #FFFDF5;
}

.bg-image {
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    position: absolute;
    background-image: url("/images/backgrounds/banner_bg.png");
    filter: contrast(65%) brightness(80%) saturate(80%);
    background-repeat: no-repeat;
    background-position: center 75%;
    background-size: 100% clamp(500px, calc(100vw / 1.5), 685px);
    animation: fadeInByX 1s;
    z-index: 99;
}

.fg-items {
    top: 20%;
    left: 10%;
    height: 80%;
    width: 50%;
    position: absolute;
    z-index: 100;
    display: flex;
    flex-direction: column;
}

.banner-heading {
    font-size: 35px;
}

.banner-promo {
    font-size: 19px;
}

.banner-button-group {
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 15px 70px;
}

.banner-button {
    color: #D1CDC8;
    padding: 10px 35px;
    border: 2px solid #D1CDC8;
    background-color: transparent;
    font-size: 16px;
    font-weight: 300;
    text-transform: none;
    display: flex;
    gap: 17px;
    transition: all .5s;
}

.banner-button:hover {
    background-color: #D1CDC8;
    color: #473E37;
}

@media(max-width: 768px) {
    .banner-heading {
        font-size: 30px;
    }

    .fg-items {
        top: 10%;
    }
}

@media(max-width: 550px) {
    .fg-items {
        width: 75%;
    }
}
</style>
