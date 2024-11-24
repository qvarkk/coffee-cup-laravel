<template>
    <InlineLoadingSpinner @click="stateStore.addNotification('Подождите...')" :size="25" :is-loading="isLoading" />
    <div class="cart-item" v-show="!isLoading">
        <div class="item-visual">
            <img class="item-image" :src="item.item.image" alt="">
            <p>{{ item.item.name }}</p>
        </div>
        <div class="item-actions">
            <input type="number" min="1" v-model="this.quantity">
            шт.
            <button class="save-button" :disabled="quantity === item.quantity || quantity < 1 || quantity > 999" @click="updateItem">
                <i class="fa-solid fa-check"></i>
            </button>
            <button class="delete-button" @click="deleteItem">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </div>
</template>

<script>
import {useUserStore} from "@/store/authStore.js";
import {removeProductFromCart, updateCartProduct} from "@/api/cart.js";
import InlineLoadingSpinner from "@/components/common/InlineLoadingSpinner.vue";
import {useStateStore} from "@/store/stateStore.js";

export default {
    name: "CartItem",
    components: {InlineLoadingSpinner},

    setup() {
        const authStore = useUserStore()
        const stateStore = useStateStore()
        return {authStore, stateStore}
    },

    data() {
        return {
            isLoading: false,
            quantity: this.item.quantity
        }
    },

    methods: {
        async updateItem() {
            this.isLoading = true
            await updateCartProduct(this.item.item.id, this.quantity)
            await this.authStore.getCartProducts()
            this.isLoading = false
        },

        async deleteItem() {
            this.isLoading = true
            await removeProductFromCart(this.item.item.id)
            await this.authStore.getCartProducts()
            this.isLoading = false
        }
    },

    props: ['item']
}
</script>

<style scoped>
.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.item-visual {
    display: flex;
    align-items: center;
    gap: 5px;
}

.item-image {
    max-height: 50px;
    border-radius: 50%;
}

.item-actions {
    display: flex;
    align-items: center;
    gap: 2px;
}

.item-actions > input {
    max-width: 35px;
    border-radius: 0;
    padding: 2px 5px;
    text-align: end;
}

.item-actions > input::-webkit-outer-spin-button,
.item-actions > input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.save-button {
    margin-left: 8px;
    border-radius: 7px;
    background-color: #35dc4b;
    padding: 7px 10px;
}

.delete-button {
    margin-left: 8px;
    border-radius: 7px;
    background-color: #dc3545;
    padding: 7px 10px;
}

</style>
