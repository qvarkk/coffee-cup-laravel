<template>
    <div class="item">
        <i class="unfav heart fa-solid fa-heart"></i>
        <img class="item-img" :src="image" alt="">
        <span class="item-name">{{ name }}</span>
        <span class="item-description">{{ description }}</span>
        <div class="item-actions">
            <span>
                {{ serving }} гр.
            </span>
            <div class="quantity-controls">
                <i @click="subtract" class="fa-solid fa-minus"></i>
                <span>{{ quantity }} шт.</span>
                <i @click="add" class="fa-solid fa-plus"></i>
            </div>
            <span class="item-price">
                {{ Math.floor(price * quantity) }}&#8381;
            </span>
        </div>
        <button class="buy-button">
            Купить
        </button>
    </div>
</template>

<script>
export default {
    name: "Item",

    data() {
        return {
            quantity: 1,
        }
    },

    methods: {
        add() {
            if (this.quantity < this.in_stock)
                this.quantity++
        },

        subtract() {
            if (this.quantity > 1)
                this.quantity--
        }
    },

    props: [
        'id', 'name', 'description', 'image', 'serving', 'price', 'in_stock'
    ]
}
</script>

<style scoped>
.item {
    border-radius: 20px;
    background-color: #f5f3eb;
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 335px;
    padding: 20px;
    gap: 10px;
    box-shadow: 2px 5px 14px 0 #A6A19D30;
    animation: fadeIn 1s;
}

.heart {
    cursor: pointer;
    align-self: start;
    font-size: 25px;
}

.unfav {
    color: #dedbd4;
}

.fav {
    color: #dc3545;
}

.item-name {
    align-self: start;
    font-weight: 600;
}

.item-description {
    text-justify: distribute-center-last;
    margin-top: -4px;
    margin-bottom: 10px;
    font-size: 12px;
}

.item-actions {
    font-size: 12px;
    display: grid;
    grid-template: 1fr / 1fr 2fr 1fr;
    justify-content: center;
    width: 100%;
    max-width: 230px;
}

.quantity-controls {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.quantity-controls > i {
    cursor: pointer;
}

.item-price {
    text-align: end;
}

.buy-button {
    font-size: 12px;
    padding: 8px 0;
    width: 100%;
    max-width: 150px;
}
</style>
