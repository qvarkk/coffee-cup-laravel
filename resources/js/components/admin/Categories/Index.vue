<template>
    <div class="container-admin">
        <h3>Категории</h3>
        <table class="table">
            <thead>
            <tr>
                <th class="bg-transparent" scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="category in categoryStore.categories">
                <CategoriesShow v-if="categoryStore.editId !== category.id" :id="category.id"
                                :name="category.name"></CategoriesShow>
                <CategoriesShowModal v-if="stateStore.activeModalId === category.id" :id="category.id" :name="category.name"></CategoriesShowModal>
            </template>
            </tbody>
        </table>
        <div>
            <button @click="stateStore.startCreating()" class="add-btn btn-action primary">
                <i class="fa-solid fa-plus"></i> Добавить
            </button>
        </div>
    </div>
    <CategoriesCreate></CategoriesCreate>
</template>

<script>
import {useCategoryStore} from "@/store/categoryStore.js";
import CategoriesShow from "@/components/admin/Categories/Show.vue"
import CategoriesEdit from "@/components/admin/Categories/Edit.vue"
import LoadingSpinner from "@/components/common/LoadingSpinner.vue";
import InlineLoadingSpinner from "@/components/common/InlineLoadingSpinner.vue";
import CategoriesCreate from "@/components/admin/Categories/Create.vue";
import CategoriesShowModal from "@/components/admin/Categories/ShowModal.vue";
import ErrorModal from "@/components/common/ErrorModal.vue";
import {useStateStore} from "@/store/stateStore.js";

export default {
    name: "CategoriesIndex",

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

    components: {
        ErrorModal,
        CategoriesShowModal,
        CategoriesCreate,
        CategoriesShow,
        CategoriesEdit,
        LoadingSpinner,
        InlineLoadingSpinner
    },

    async mounted() {
        this.stateStore.startLoading()
        await this.categoryStore.getCategories()
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
