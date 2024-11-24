<template>
    <div v-if="this.authStore.user" class="cart" :style="`right: ${this.right}`">
        <template v-for="item in this.authStore.cartItems">
            <CartItem :item="item" />
        </template>
        <div v-if="this.authStore.cartItems.length === 0" class="empty-text">
            В корзине как-то пусто :(
        </div>
    </div>
</template>

<script>
import {useUserStore} from "@/store/authStore.js";
import CartItem from "@/components/user/Homepage/CartItem.vue";

export default {
    name: "CartModule",
    components: {CartItem},

    data() {
        return {
            items: [],
        }
    },

    setup() {
        const authStore = useUserStore()
        return {authStore}
    },

    async mounted() {
        this.authStore.getCartProducts()
    },

    props: ['right']
}
</script>

<style scoped>
.cart {
    position: absolute;
    z-index: 1000;
    top: 55px;
    padding: 10px 20px;
    background-color: #f5f3eb;
    display: flex;
    flex-direction: column;
    gap: 10px;
    border-radius: 7px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.empty-text {
    white-space: nowrap;
    padding: 10px 25px;
}
</style>
