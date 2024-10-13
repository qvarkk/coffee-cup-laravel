<template>
    <div class="container-admin">
        <h3>Categories</h3>
        <table class="table">
            <thead>
            <tr>
                <th class="bg-transparent" scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                <template v-for="category in categoryStore.categories">
                    <CategoriesShow v-if="this.categoryStore.editId !== category.id" :id="category.id"
                                    :name="category.name"></CategoriesShow>
                    <CategoriesEdit v-if="this.categoryStore.editId === category.id" :id="category.id"
                                    :name="category.name"></CategoriesEdit>
                </template>
                <th scope="row">#</th>
                <td><input type="text" v-model="this.name"></td>
                <td>
                    <button @click="this.categoryStore.createCategory(this.name); this.name = ''" class="btn-action" :disabled="name === ''">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </td>
            </tbody>
        </table>
    </div>
</template>

<script>
import {useCategoryStore} from "@/store/categoryStore.js";
import CategoriesShow from "@/components/admin/Categories/Show.vue"
import CategoriesEdit from "@/components/admin/Categories/Edit.vue"

export default {
    name: "CategoriesIndex",

    setup() {
        const categoryStore = useCategoryStore()
        return {categoryStore}
    },

    data() {
        return {
            name: ''
        }
    },

    components: {
        CategoriesShow,
        CategoriesEdit
    },

    async mounted() {
        await this.categoryStore.getCategories()
        console.log(this.categoryStore.categories);
    },
}
</script>

<style>
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 15px;
    text-align: left;
    border: 1px solid #dee2e6;
}

.table thead {
    background-color: #f8f9fa; /* Light background for the header */
}

.table tbody tr:hover {
    background-color: #f1f1f1; /* Change background on hover */
}

.table .bg-transparent {
    background-color: transparent; /* Keep header background transparent */
}

.btn-action {
    padding: 6px 12px;
    margin: 0 5px;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
}

.btn-action:last-child {
    background-color: #dc3545; /* Bootstrap danger color */
}

.btn-action:first-child {
background-color: #007bff; /* Bootstrap primary color */
}
</style>
