<template>
    <Header></Header>
    <main class="main">
        <router-view></router-view>
    </main>
    <Footer></Footer>
</template>

<script>
import Header from "@/components/layout/Header.vue";
import Footer from "@/components/layout/Footer.vue";

export default {
    name: "Index",

    components: {
        Header,
        Footer,
    }
}
</script>

<style scoped>

</style>
