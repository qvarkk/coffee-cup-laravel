<template>
    <tr>
        <th scope="row">{{ id }}</th>
        <td @click="stateStore.setActiveModalId(id)">{{ name }}</td>
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
import {useCategoryStore} from "@/store/categoryStore.js";
import {useStateStore} from "@/store/stateStore.js";

export default {
    name: "CategoriesShow",

    setup() {
        const categoryStore = useCategoryStore()
        const stateStore = useStateStore()
        return {categoryStore, stateStore}
    },

    methods: {
        openEdit() {
            this.stateStore.setActiveModalId(this.id)
            this.stateStore.startEditing()
        },

        async deleteCategory() {
            this.stateStore.startLoading()
            let res = await this.categoryStore.deleteCategory(this.id)
            await this.categoryStore.getCategories()

            if (Math.floor(res.status / 100) !== 2) {
                this.stateStore.showErrorModal(res.response.data.errors)
            }

            this.stateStore.endLoading()
        }
    },

    props: [
        'id',
        'name',
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
