<template>
    <div class="dialog-top">
        <h3>Изменение</h3>
        <i @click="stateStore.closeActiveModal()" class="close-sidebar fa-solid fa-xmark fa-xl"></i>
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
            <th>ID</th>
            <td>{{ id }}</td>
        </tr>
        <tr>
            <th>Название</th>
            <td><input type="text" v-model="name"></td>
        </tr>
        <tr>
            <th>Описание</th>
            <td><input type="text" v-model="description"></td>
        </tr>
        <tr>
            <th>Изображение (ссылка)</th>
            <td><input type="text" v-model="image"></td>
        </tr>
        <tr>
            <th>Категория</th>
            <td>
                <select v-model="category_id">
                    <option disabled>Выберите категорию</option>
                    <template v-for="category in categories">
                        <option :selected="category.id === this.category_id" :value="category.id">{{
                                category.name
                            }}
                        </option>
                    </template>
                </select>
            </td>
        </tr>
        <tr>
            <th>Объем</th>
            <td><input type="number" v-model="serving"></td>
        </tr>
        <tr>
            <th>В наличии</th>
            <td><input type="number" v-model="in_stock"></td>
        </tr>
        <tr>
            <th>Цена</th>
            <td><input type="number" v-model="price"></td>
        </tr>
        </tbody>
    </table>
    <div class="dialog-bottom">
        <button @click="updateCategory" class="btn-action primary" :disabled="this.name === this.product.name &&
           this.description === this.product.description &&
           this.image === this.product.image &&
           this.category_id === this.product.category.id &&
           this.serving === this.product.serving &&
           this.in_stock === this.product.in_stock &&
           this.price === this.product.price">
            <i class="fa-solid fa-check fa-xl"></i>
        </button>
        <button @click="this.stateStore.endEditing()" class="btn-action danger">
            <i class="fa-solid fa-xmark fa-xl"></i>
        </button>
    </div>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";
import {useProductStore} from "@/store/productStore.js";

export default {
    name: "UsersEdit",

    data() {
        return {
            id: this.product.id,
            name: this.product.name,
            description: this.product.description,
            image: this.product.image,
            category_id: this.product.category.id,
            serving: this.product.serving,
            in_stock: this.product.in_stock,
            price: this.product.price
        }
    },

    setup() {
        const productStore = useProductStore()
        const stateStore = useStateStore()
        return {productStore, stateStore}
    },

    methods: {
        async updateCategory() {
            this.stateStore.startLoading()

            let product = {
                id: this.id,
                name: this.name,
                description: this.description,
                image: this.image,
                category_id: this.category_id,
                serving: this.serving,
                in_stock: this.in_stock,
                price: this.price
            }

            let res = await this.productStore.updateProduct(product)

            if (Math.floor(res.status / 100) === 2) {
                await this.productStore.getProducts()
                this.stateStore.closeActiveModal()
            } else {
                this.stateStore.showErrorModal(res.response.data.errors)
            }

            this.stateStore.endLoading()
        }
    },

    props: [
        'product',
        'categories'
    ],
}
</script>

<style scoped>
.dialog h3 {
    margin-top: 0;
    font-size: 1.5rem;
    text-align: center;
}

.dialog td {
    width: 100%;
}

.dialog-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.dialog-bottom {
    display: flex;
    justify-content: end;
    align-items: center;
    margin-top: 15px;
}

.dialog table {
    width: 100%;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 15px;
    text-align: left;
    border: 1px solid #dee2e6;
}

thead {
    background-color: #f8f9fa;
}

tbody tr:hover {
    background-color: #f1f1f1;
}
</style>
