<template>
    <Header v-if="!mobileView"></Header>
    <HeaderMobile @update-show="updateShowState" :class="{'out-of-screen':!showNav}" v-if="mobileView"></HeaderMobile>
    <main class="main" :class="{'open':showNav}">
        <div v-if="mobileView" class="menu-button">
            <img @click="updateShowState" src="/images/icons/menu.svg" alt="Open Sidebar">
        </div>
        <router-view></router-view>
    </main>
    <Footer :class="{'open':showNav}"></Footer>
</template>

<script>
import Header from "@/components/common/Header.vue";
import Footer from "@/components/common/Footer.vue";
import HeaderMobile from "@/components/common/HeaderMobile.vue";

export default {
    name: "UserLayout",

    data() {
        return {
            mobileView: true,
            showNav: false
        }
    },

    methods: {
        handleView() {
            this.mobileView = window.visualViewport.width <= 768
            if (window.visualViewport.width > 768) {
                this.showNav = false;
            }
        },

        updateShowState() {
            this.showNav = !this.showNav
            if (this.showNav) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'scroll';
            }
        }
    },

    components: {
        HeaderMobile,
        Header,
        Footer
    },

    created() {
        this.handleView()
        window.addEventListener('resize', this.handleView)
    }
}
</script>

<style scoped>
.header,
.main,
.footer {
    transition: 1s transform cubic-bezier(.29,0,.13,.99);
}

.menu-button {
    padding: 35px;
}

.menu-button > img {
    cursor: pointer;
}

.open {
    transform: translateX(300px);
}

.out-of-screen {
    transform: translateX(-500px);
}
</style>
