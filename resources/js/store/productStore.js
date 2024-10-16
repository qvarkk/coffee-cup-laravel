import {defineStore} from "pinia";
import {createProduct, deleteProduct, getProducts, updateProduct} from "@/api/products.js";

export const useProductStore = defineStore('products', {
    state: () => ({
        products: null,
    }),

    actions: {
        async getProducts() {
            let res = await getProducts()
            this.products = res.data.data
            return res
        },

        async createProduct(product) {
            return await createProduct(product)
        },

        async updateProduct(product) {
            return await updateProduct(product)
        },

        async deleteProduct(id) {
            return await deleteProduct(id)
        }
    }
})
