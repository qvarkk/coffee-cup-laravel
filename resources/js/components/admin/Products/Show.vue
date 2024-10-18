<template>
    <tr>
        <th scope="row">{{ product.id }}</th>
        <td @click="stateStore.setActiveModalId(product.id)">{{ product.name }}</td>
        <td @click="stateStore.setActiveModalId(product.id)">{{ product.category.name }}</td>
        <td @click="stateStore.setActiveModalId(product.id)">{{ product.price }}</td>
        <td @click="stateStore.setActiveModalId(product.id)">{{ product.in_stock }}</td>
        <td>
            <button @click="openEdit" class="btn-action primary">
                <i class="fa-solid fa-pencil"></i>
            </button>
            <button @click="deleteCategory" class="btn-action danger">
                <i class="fa-solid fa-trash"></i>
            </button>
        </td>
    </tr>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";
import {useProductStore} from "@/store/productStore.js";

export default {
    name: "ProductsShow",

    setup() {
        const productStore = useProductStore()
        const stateStore = useStateStore()
        return {productStore, stateStore}
    },

    methods: {
        openEdit() {
            this.stateStore.setActiveModalId(this.product.id)
            this.stateStore.startEditing()
        },

        async deleteCategory() {
            this.stateStore.startLoading()
            let res = await this.productStore.deleteProduct(this.product.id)
            await this.productStore.getProducts()

            if (Math.floor(res.status / 100) !== 2) {
                this.stateStore.showErrorModal(res.response.data.errors)
            }

            this.stateStore.endLoading()
        }
    },

    props: [
        'product'
    ],
}
</script>

<style scoped>
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
