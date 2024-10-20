<template>
    <div class="about-us">
        <div class="container">
            <h3>Подробнее о нас</h3>
            <div class="content">
                <div class="item">
                    <img src="/images/icons/coffee_beans.svg" alt="">
                    <span>Качественное сырьё от проверенных поставщиков кофе. Оптовые поставки лучших сортов кофе с уникальными вкусовыми  и ароматическими свойствами, которые оценит любой кофеман.</span>
                </div>
                <div class="item">
                    <img src="/images/icons/coffee_breawing.svg" alt="">
                    <span>Профессиональное оборудование для приготовления кофе-напитков из зернового кофе от производителя. У нас есть всё: от мультифункциональных эспрессо-машин и миниатюрных кофеварок до аксессуаров и водоочистительных приборов.</span>
                </div>
                <div class="item">
                    <img src="/images/icons/coffee_bag.svg" alt="">
                    <span>Жарим кофе семь дней в неделю, отправляем на следующий день после заказа, чтобы вы получали максимально свежий кофе. Обработка путём грамотной обжарки и последующая упаковка кофе в 1 кг в специальные пакеты с фирменным логотипом.</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AboutUs"
}
</script>

<style scoped>
.about-us {
    width: 100%;
    background-color: #3C342E;
    color: #FFFDF5;
    padding: 50px 0;
}

h3 {
    font-size: 25px;
    margin-bottom: 50px;
}

span {
    font-size: 16px;
    text-align: center;
}

.content {
    display: flex;
    flex-wrap: wrap;
    gap: 50px;
    justify-content: center;
}

.item {
    max-width: 310px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

@media(max-width: 1115px) {
    h3 {
        text-align: center;
    }

    span {
        text-align: left;
    }

    .item {
        max-width: 100%;
        flex-direction: row;
    }
}

@media(max-width: 320px) {
    span {
        text-align: center;
    }

    .item {
        max-width: 310px;
        flex-direction: column;
    }
}
</style>
