<template>
    <div class="dialog-overlay" v-if="stateStore.isCreating">
        <div class="dialog">
            <div class="dialog-top">
                <h3>Добавление</h3>
                <i @click="cancelCreating()" class="close-sidebar fa-solid fa-xmark fa-xl"></i>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Свойство</th>
                    <th>Значение</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Название</th>
                    <td class="table-input"><input type="text" v-model="name"></td>
                </tr>
                </tbody>
            </table>
            <div class="dialog-bottom">
                <button @click="createCategory" class="btn-action primary" :disabled="name === ''">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <button @click="cancelCreating()" class="btn-action danger">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {useCategoryStore} from "@/store/categoryStore.js";
import {useStateStore} from "@/store/stateStore.js";

export default {
    name: "CategoriesCreate",

    setup() {
        const categoryStore = useCategoryStore()
        const stateStore = useStateStore()
        return {categoryStore, stateStore}
    },

    data() {
        return {
            name: '',
        }
    },

    methods: {
        async createCategory() {
            this.stateStore.startLoading()
            let res = await this.categoryStore.createCategory(this.name)

            if (Math.floor(res.status / 100) === 2) {
                await this.categoryStore.getCategories()
                this.stateStore.endCreating()
                this.name = ''
            } else {
                this.stateStore.showErrorModal(res.response.data.errors)
            }

            this.stateStore.endLoading()
        },

        cancelCreating() {
            this.name = ''
            this.stateStore.endCreating()
        }
    }
}
</script>

<style scoped>

</style>
