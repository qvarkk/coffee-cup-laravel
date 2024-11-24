<template>
    <div class="item">
        <i v-if="!loadingFavorites" @click="addToFavorites" :class="favorited ? 'fav' : 'unfav'"
           class="heart fa-solid fa-heart"></i>
        <InlineLoadingSpinner @click="stateStore.addNotification('Подождите...')" class="loading-spinner" :size="25"
                              :is-loading="loadingFavorites"></InlineLoadingSpinner>
        <img v-show="imageLoaded" class="item-img" :src="image" alt="" @load="onImgLoad">
        <div v-show="!imageLoaded" class="item-img-loading">
            <InlineLoadingSpinner :size="50" :isLoading="true"></InlineLoadingSpinner>
        </div>
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
        <button v-if="!loadingCartButton" class="buy-button" @click.prevent="addToCart">
            <i class="fa-solid fa-basket-shopping"></i>
            &nbsp;&nbsp;

            <span v-if="!this.carted">добавить</span>
            <span v-else>{{ this.carted.quantity }} шт.</span>
        </button>
        <InlineLoadingSpinner @click="stateStore.addNotification('Подождите...')" class="loading-spinner-cart" :size="25"
                              :is-loading="loadingCartButton"></InlineLoadingSpinner>
    </div>
</template>

<script>
import {useUserStore} from "@/store/authStore.js";
import InlineLoadingSpinner from "@/components/common/InlineLoadingSpinner.vue";
import {useHomepageStateStore} from "@/store/homepageStateStore.js";

export default {
    name: "Item",
    components: {InlineLoadingSpinner},

    setup() {
        const stateStore = useHomepageStateStore()
        const authStore = useUserStore()
        return {stateStore, authStore}
    },

    data() {
        return {
            quantity: 1,
            loadingFavorites: false,
            loadingCartButton: false,
            imageLoaded: false,
        }
    },

    computed: {
        favorited() {
            return this.authStore.favorites.includes(this.id)
        },
        carted() {
            return this.authStore.cartItems.find(o => o.item.id === this.id)
        }
    },

    methods: {
        onImgLoad() {
            this.imageLoaded = true
        },

        add() {
            if (this.quantity < 99)
                this.quantity++
        },

        subtract() {
            if (this.quantity > 1)
                this.quantity--
        },

        async addToFavorites() {
            if (!this.authStore.user) {
                this.stateStore.addNotification('Авторизуйтесь для добавления в избранное')
            } else {
                this.loadingFavorites = true
                if (this.favorited) {
                    await this.authStore.removeFavoritedProduct(this.id)
                } else {
                    await this.authStore.addFavoritedProduct(this.id)
                }
                await this.authStore.getFavoritedProducts()
                this.loadingFavorites = false
            }
        },

        async addToCart() {
            if (!this.authStore.user) {
                this.stateStore.addNotification('Авторизуйтесь для добавления в корзину')
            } else {
                this.loadingCartButton = true
                if (this.carted) {
                    await this.authStore.updateCartProduct(this.id, this.carted.quantity + this.quantity)
                } else {
                    await this.authStore.addProductToCart(this.id, this.quantity)
                }

                await this.authStore.getCartProducts()
                this.loadingCartButton = false
            }
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
    width: 100%;
    padding: 20px;
    gap: 10px;
    box-shadow: 2px 5px 14px 0 #A6A19D30;
    animation: fadeIn 1s;
}

.item > img {
    max-width: 200px;
    max-height: 200px;
}

.item-img-loading {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 200px;
    height: 200px;
}

.loading-spinner {
    margin: 0 !important;
    align-self: start;
}

.loading-spinner-cart {
    margin: 0 !important;
    align-self: center;
}

.heart {
    position: relative;
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
    align-self: start;
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
