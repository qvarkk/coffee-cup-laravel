<template>
    <div class="dialog-overlay">
        <div class="dialog">
            <ProductsEdit v-if="stateStore.isEditing" :product="product" :categories="categories"></ProductsEdit>
            <template v-if="!stateStore.isEditing">
                <div class="dialog-top">
                    <h3>Подробности</h3>
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
                        <td>{{ product.id }}</td>
                    </tr>
                    <tr>
                        <th>Название</th>
                        <td @click="stateStore.startEditing">{{ product.name }}</td>
                    </tr>
                    <tr>
                        <th>Описание</th>
                        <td @click="stateStore.startEditing">{{ product.description }}</td>
                    </tr>
                    <tr>
                        <th>Изображение (ссылка)</th>
                        <td @click="stateStore.startEditing">{{ product.image }}</td>
                    </tr>
                    <tr>
                        <th>Категория</th>
                        <td @click="stateStore.startEditing">{{ product.category.name }}</td>
                    </tr>
                    <tr>
                        <th>Объем</th>
                        <td @click="stateStore.startEditing">{{ product.serving }}</td>
                    </tr>
                    <tr>
                        <th>В наличии</th>
                        <td @click="stateStore.startEditing">{{ product.in_stock }}</td>
                    </tr>
                    <tr>
                        <th>Цена</th>
                        <td @click="stateStore.startEditing">{{ product.price }}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="dialog-bottom">
                    <button @click="stateStore.startEditing" class="btn-action primary">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <button @click="deleteProduct" class="btn-action danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";
import {useProductStore} from "@/store/productStore.js";
import ProductsEdit from "@/components/admin/Products/Edit.vue";

export default {
    name: "ProductsShowModal",
    components: {ProductsEdit},

    setup() {
        const productStore = useProductStore()
        const stateStore = useStateStore()
        return {productStore, stateStore}
    },

    methods: {
        async deleteProduct() {
            this.stateStore.closeActiveModal()
            this.stateStore.startLoading()
            let res = await this.productStore.deleteProduct(this.id)
            await this.productStore.getProducts()

            if (Math.floor(res.status / 100) !== 2) {
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
