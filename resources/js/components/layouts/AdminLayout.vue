<template>
    <LoadingSpinner :isLoading="stateStore.isLoading"></LoadingSpinner>
    <ErrorModal v-if="stateStore.showError" :messages="stateStore.messages"></ErrorModal>
    <Sidebar @update-show="updateShowState" :class="{'out-of-screen':!showNav}"></Sidebar>
    <main class="main" :class="{ 'open': showNav }">
        <div class="menu-button">
            <img @click="updateShowState" src="/images/icons/menu.svg" alt="Open Sidebar">
        </div>
        <router-view></router-view>
    </main>
</template>

<script>
import Sidebar from "@/components/common/Sidebar.vue";
import LoadingSpinner from "@/components/common/LoadingSpinner.vue";
import ErrorModal from "@/components/common/ErrorModal.vue";
import {useStateStore} from "@/store/stateStore.js";

export default {
    name: "AdminLayout",

    setup() {
        const stateStore = useStateStore()
        return {stateStore}
    },

    components: {
        ErrorModal,
        LoadingSpinner,
        Sidebar,
    },

    data() {
        return {
            showNav: false,
        }
    },

    methods: {
        updateShowState() {
            this.showNav = !this.showNav
            if (this.showNav) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'scroll';
            }
        }
    }
}
</script>

<style scoped>
.sidebar,
.main {
    transition: .5s transform cubic-bezier(.29, 0, .13, .99);
}

.menu-button {
    padding: 35px;
}

.menu-button > img {
    cursor: pointer;
}

.open {
    transform: translateX(350px);
}

.out-of-screen {
    transform: translateX(-500px);
}
</style>
