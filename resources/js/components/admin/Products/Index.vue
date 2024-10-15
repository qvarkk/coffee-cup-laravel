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
                <ProductsShow :id="product.id"
                              :name="product.name" :category="product.category.name" :price="product.price"
                              :in_stock="product.in_stock"></ProductsShow>
                <ProductsShowModal v-if="stateStore.activeModalId === product.id" :id="product.id"
                                   :name="product.name" :category="product.category.name" :price="product.price"
                                   :in_stock="product.in_stock"></ProductsShowModal>
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
        await this.productStore.getProducts()
        let res = await this.categoryStore.getCategories()
        this.categories = res.data.data
        this.stateStore.endLoading()
    },
}
</script>

<style>
/deep/ input {
    width: 100%;
    border-radius: 0 !important;
    background-color: #fff !important;
    height: 100%;
}

/deep/ .table {
    width: 100%;
    border-collapse: collapse;
}

/deep/ .table th,
/deep/ .table td {
    padding: 15px;
    text-align: left;
    border: 1px solid #dee2e6;
}

/deep/ .table thead {
    background-color: #f8f9fa;
}

/deep/ .table tbody tr:hover {
    background-color: #f1f1f1;
}

/deep/ .table .bg-transparent {
    background-color: transparent;
}

/deep/ .btn-action {
    padding: 6px 12px;
    margin: 0 5px;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
}

/deep/ .danger {
    background-color: #dc3545;
}

/deep/ .primary {
    background-color: #007bff;
}

.add-btn {
    text-transform: none;
    margin: 0 15px;
}

</style>
