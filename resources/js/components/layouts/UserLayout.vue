<template>
    <Header></Header>
    <main class="main">
        <router-view></router-view>
    </main>
    <Footer></Footer>
</template>

<script>
import Header from "@/components/common/Header.vue";
import Footer from "@/components/common/Footer.vue";

export default {
    name: "UserLayout",
    components: {
        Header,
        Footer
    }
}
</script>

<style scoped>

</style>
