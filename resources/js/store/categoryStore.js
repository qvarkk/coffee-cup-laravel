import {defineStore} from "pinia";
import {deleteCategory, getCategories, updateCategory} from "@/api/categories.js";
import {createCategory} from "@/api/categories";

export const useCategoryStore = defineStore('categories', {
    state: () => ({
        categories: null,
    }),

    actions: {
        async getCategories() {
            let res = await getCategories()
            this.categories = res.data.data
            return res
        },

        async createCategory(name) {
            return await createCategory(name)
        },

        async updateCategory(id, name) {
            return await updateCategory(id, name)
        },

        async deleteCategory(id) {
            return await deleteCategory(id)
        }
    }
})
