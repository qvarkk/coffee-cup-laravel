import {defineStore} from "pinia";
import {getCurrentUser} from "@/api/users.js";
import {addFavoritedProduct, getFavoritedProducts, removeFavoritedProduct} from "@/api/favorites.js";
import {addProductToCart, getCartProducts, removeProductFromCart, updateCartProduct} from "@/api/cart.js";
import {getProduct} from "@/api/products.js";

export const useUserStore = defineStore('auth', {
    state: () => ({
        user: null,
        favorites: [],
        cartItems: [],
    }),

    actions: {
        async fetchUser() {
            const token = localStorage.getItem('access_token')
            if (token) {
                const res = await getCurrentUser()
                this.user = res.data
            } else {
                this.user = null
            }
        },

        logout() {
            localStorage.removeItem('access_token')
            this.user = null
        },

        async getFavoritedProducts() {
            let res = await getFavoritedProducts()
            this.favorites = res.data.data.products
            return res.data.data
        },

        async addFavoritedProduct(productId) {
            return await addFavoritedProduct(productId)
        },

        async removeFavoritedProduct(productId) {
            return await removeFavoritedProduct(productId)
        },

        async getCartProducts() {
            let res = await getCartProducts()
            this.cartItems = res.data.data
            return res.data.data
        },

        async getProduct(id) {
            let res = await getProduct(id)
            return res.data.data
        },

        async addProductToCart(productId, quantity) {
            return await addProductToCart(productId, quantity)
        },

        async removeProductFromCart(productId) {
            return await removeProductFromCart(productId)
        },

        async updateCartProduct(productId, quantity) {
            return await updateCartProduct(productId, quantity)
        }
    }
})
