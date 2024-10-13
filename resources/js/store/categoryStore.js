import {defineStore} from "pinia";
import {deleteCategory, getCategories, updateCategory} from "@/api/categories.js";
import {createCategory} from "@/api/categories";

export const useCategoryStore = defineStore('categories', {
    state: () => ({
        categories: null,
        editId: null,
    }),

    actions: {
        async getCategories() {
            let res = await getCategories()
            this.categories = res.data
        },

        setEditId(id) {
            this.editId = id
        },

        async createCategory(name) {
            await createCategory(name)
            await this.getCategories()
        },

        async updateCategory(id, name) {
            await updateCategory(id, name)
            this.setEditId(null)
            await this.getCategories()
        },

        async deleteCategory(id) {
            await deleteCategory(id)
            await this.getCategories()
        }
    }
})
