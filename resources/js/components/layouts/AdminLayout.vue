<template>
    <Sidebar></Sidebar>
        <main>
            <router-view></router-view>
        </main>
</template>

<script>
import Sidebar from "@/components/common/Sidebar.vue";

export default {
    name: "AdminLayout",
    components: {
        Sidebar,
    }
}
</script>

<style scoped>

</style>
