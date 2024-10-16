<template>
    <div class="dialog-top">
        <h3>Изменение</h3>
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
            <td>{{ id }}</td>
        </tr>
        <tr>
            <th>Название</th>
            <td><input type="text" v-model="this._name"></td>
        </tr>
        </tbody>
    </table>
    <div class="dialog-bottom">
        <button @click="updateCategory" class="btn-action primary" :disabled="this._name === name">
            <i class="fa-solid fa-check fa-xl"></i>
        </button>
        <button @click="this.stateStore.endEditing()" class="btn-action danger">
            <i class="fa-solid fa-xmark fa-xl"></i>
        </button>
    </div>
</template>

<script>
import {useCategoryStore} from "@/store/categoryStore.js";
import InlineLoadingSpinner from "@/components/common/InlineLoadingSpinner.vue";
import {useStateStore} from "@/store/stateStore.js";

export default {
    name: "CategoriesEdit",

    components: {
        InlineLoadingSpinner
    },

    data() {
        return {
            _name: this.name
        }
    },

    setup() {
        const categoryStore = useCategoryStore()
        const stateStore = useStateStore()
        return {categoryStore, stateStore}
    },

    methods: {
        async updateCategory() {
            this.stateStore.startLoading()
            let res = await this.categoryStore.updateCategory(this.id, this._name)
            if (Math.floor(res.status / 100) === 2) {
                await this.categoryStore.getCategories()
                this.stateStore.closeActiveModal()
            } else {
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
