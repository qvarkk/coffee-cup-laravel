<template>
    <div class="container-admin">
        <h3>Товары</h3>
        <table class="table">
            <thead>
            <tr>
                <th class="bg-transparent" scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Категория</th>
                <th scope="col">Цена</th>
                <th scope="col">В наличии</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="product in productStore.products">
                <ProductsShow :id="product.id" :product="product"></ProductsShow>
                <ProductsShowModal v-if="stateStore.activeModalId === product.id" :product="product"
                                   :categories="categories"></ProductsShowModal>
            </template>
            </tbody>
        </table>
        <div>
            <button @click="stateStore.startCreating()" class="add-btn btn-action primary">
                <i class="fa-solid fa-plus"></i> Добавить
            </button>
        </div>
    </div>
    <ProductsCreate :categories="categories"></ProductsCreate>
</template>

<script>
import ProductsShow from "@/components/admin/Products/Show.vue"
import LoadingSpinner from "@/components/common/LoadingSpinner.vue";
import ProductsCreate from "@/components/admin/Products/Create.vue";
import ProductsShowModal from "@/components/admin/Products/ShowModal.vue";
import ErrorModal from "@/components/common/ErrorModal.vue";
import {useStateStore} from "@/store/stateStore.js";
import {useProductStore} from "@/store/productStore.js";
import {useCategoryStore} from "@/store/categoryStore.js";

export default {
    name: "ProductsIndex",

    setup() {
        const productStore = useProductStore()
        const categoryStore = useCategoryStore()
        const stateStore = useStateStore()
        return {productStore, categoryStore, stateStore}
    },

    data() {
        return {
            categories: null
        }
    },

    components: {
        ProductsShow,
        ProductsShowModal,
        ProductsCreate,
        ErrorModal,
        LoadingSpinner,
    },

    async mounted() {
        this.stateStore.startLoading()
        let res = await this.productStore.getProducts()
        let res_cat = await this.categoryStore.getCategories()

        let showErrors = false
        let errors = []

        if (Math.floor(res.status / 100) !== 2) {
            errors += res.response.data.errors
            showErrors = true
        }

        if (Math.floor(res_cat.status / 100) !== 2) {
            errors += res_cat.response.data.errors
            showErrors = true
        } else {
            this.categories = res.data.data
        }

        if (showErrors)
            this.stateStore.showErrorModal(errors)

        this.stateStore.endLoading()
    },
}
</script>

<style scoped>
:deep(input) {
    width: 100%;
    border-radius: 0 !important;
    background-color: #fff !important;
    height: 100%;
    padding: 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    padding: 15px;
    text-align: left;
    border: 1px solid #dee2e6;
}

.table thead {
    background-color: #f8f9fa;
}

.add-btn {
    text-transform: none;
    margin: 0 15px;
}
</style>
