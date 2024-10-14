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
                <tr>
                    <th>Описание</th>
                    <td class="table-input"><input type="text" v-model="description"></td>
                </tr>
                <tr>
                    <th>Изображение (ссылка)</th>
                    <td class="table-input"><input type="text" v-model="image"></td>
                </tr>
                <tr>
                    <th>Категория</th>
                    <td class="table-input">
                        <select v-model="category_id">
                            <template v-for="category in categories">
                                <option :value="category.id">{{ category.name }}</option>
                            </template>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Объем</th>
                    <td class="table-input"><input type="number" v-model="serving"></td>
                </tr>
                <tr>
                    <th>В наличии</th>
                    <td class="table-input"><input type="number" v-model="in_stock"></td>
                </tr>
                <tr>
                    <th>Цена</th>
                    <td class="table-input"><input type="number" v-model="price"></td>
                </tr>
                </tbody>
            </table>
            <div class="dialog-bottom">
                <button @click="createCategory" class="btn-action primary"
                        :disabled="name === '' || description === '' || image === '' || !category_id || !serving || !in_stock || !price">
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
import {useProductStore} from "@/store/productStore.js";

export default {
    name: "ProductsCreate",

    setup() {
        const categoryStore = useCategoryStore()
        const productStore = useProductStore()
        const stateStore = useStateStore()
        return {categoryStore, productStore, stateStore}
    },

    data() {
        return {
            name: '',
            description: '',
            image: '',
            category_id: null,
            serving: null,
            in_stock: null,
            price: null
        }
    },

    methods: {
        async createCategory() {
            this.stateStore.startLoading()
            let res = await this.productStore.createProduct(this.name, this.description, this.image, this.category_id, this.serving, this.in_stock, this.price)

            if (Math.floor(res.status / 100) === 2) {
                await this.productStore.getProducts()
                this.stateStore.endCreating()
                this.name = ''
            } else {
                this.stateStore.showErrorModal(res.response.data.errors)
            }

            this.stateStore.endLoading()
        },

        cancelCreating() {
            this.name = ''
            this.description = ''
            this.image = ''
            this.category_id = null
            this.serving = null
            this.in_stock = null
            this.price = null
            this.stateStore.endCreating()
        }
    },

    props: [
        'categories'
    ]
}
</script>

<style scoped>

</style>
