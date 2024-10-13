<template>
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

export default {
    name: "AdminLayout",

    components: {
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
