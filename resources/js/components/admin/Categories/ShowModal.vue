<template>
    <div class="dialog-overlay">
        <div class="dialog">
            <CategoriesEdit v-if="stateStore.isEditing" :id="id" :name="name"></CategoriesEdit>
            <template v-if="!stateStore.isEditing">
                <div class="dialog-top">
                    <h3>Подробности</h3>
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
                        <td @click="stateStore.startEditing">{{ name }}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="dialog-bottom">
                    <button @click="stateStore.startEditing" class="btn-action primary">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <button @click="deleteCategory" class="btn-action danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import {useStateStore} from "@/store/stateStore.js";
import {useCategoryStore} from "@/store/categoryStore.js";
import CategoriesEdit from "@/components/admin/Categories/Edit.vue";

export default {
    name: "CategoriesShowModal",
    components: {CategoriesEdit},

    setup() {
        const categoryStore = useCategoryStore()
        const stateStore = useStateStore()
        return {categoryStore, stateStore}
    },

    methods: {
        async deleteCategory() {
            this.stateStore.closeActiveModal()
            this.stateStore.startLoading()
            await this.categoryStore.deleteCategory(this.id)
            await this.categoryStore.getCategories()
            this.stateStore.endLoading()
        }
    },

    props: [
        'id', 'name'
    ]
}
</script>

<style>
.dialog-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 500;
}

.dialog {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 501;
    animation: fadeIn 0.3s ease-in-out;
}

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

.table-input {
    padding: 0 !important;
    height: 100%;
    background-color: #fff !important;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
