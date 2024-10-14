<template>
    <tr>
        <th scope="row">{{ id }}</th>
        <td @click="stateStore.setActiveModalId(id)">{{ name }}</td>
        <td @click="stateStore.setActiveModalId(id)">{{ category }}</td>
        <td @click="stateStore.setActiveModalId(id)">{{ price }}</td>
        <td @click="stateStore.setActiveModalId(id)">{{ in_stock }}</td>
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
            this.stateStore.setActiveModalId(this.id)
            this.stateStore.startEditing()
        },

        async deleteCategory() {
            this.stateStore.startLoading()
            await this.productStore.deleteProduct(this.id)
            await this.productStore.getProducts()
            this.stateStore.endLoading()
        }
    },

    props: [
        'id',
        'name',
        'category',
        'price',
        'in_stock'
    ],
}
</script>

<style scoped>

</style>
