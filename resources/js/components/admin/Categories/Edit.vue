<template>
    <tr>
        <th scope="row">{{ id }}</th>
        <td><input type="text" v-model="this._name"></td>
        <td>
            <button @click="this.categoryStore.updateCategory(id, this._name)" class="btn-action">
                <i class="fa-solid fa-check"></i>
            </button>
            <button @click="this.categoryStore.setEditId(null)" class="btn-action">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </td>
    </tr>
</template>

<script>
import {useCategoryStore} from "@/store/categoryStore.js";

export default {
    name: "CategoriesEdit",

    data() {
        return {
            _name: this.name
        }
    },

    setup() {
        const categoryStore = useCategoryStore()
        return {categoryStore}
    },

    methods: {

    },

    props: [
        'id',
        'name',
    ],
}
</script>

<style scoped>

</style>
