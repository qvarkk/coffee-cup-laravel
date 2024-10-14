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

        async createProduct(name, description, image, category_id, serving, in_stock, price) {
            return await createProduct(name, description, image, category_id, serving, in_stock, price)
        },

        async updateProduct(id, name, description, image, category_id, serving, in_stock, price) {
            return await updateProduct(id, name, description, image, category_id, serving, in_stock, price)
        },

        async deleteProduct(id) {
            return await deleteProduct(id)
        }
    }
})
