<template>
    <tr>
        <th scope="row">{{ id }}</th>
        <td>{{ name }}</td>
        <td>
            <button @click="this.categoryStore.setEditId(id)" class="btn-action">
                <i class="fa-solid fa-pencil"></i>
            </button>
            <button @click="this.categoryStore.deleteCategory(id)" class="btn-action">
                <i class="fa-solid fa-trash"></i>
            </button>
        </td>
    </tr>
</template>

<script>
import {useCategoryStore} from "@/store/categoryStore.js";

export default {
    name: "CategoriesShow",

    setup() {
        const categoryStore = useCategoryStore()
        return {categoryStore}
    },

    props: [
        'id',
        'name',
    ],
}
</script>

<style scoped>

</style>
