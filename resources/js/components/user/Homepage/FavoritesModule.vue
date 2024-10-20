<template>

</template>

<script>
import {useUserStore} from "@/store/authStore.js";

export default {
    name: "FavoritesModule",

    setup() {
        const authStore = useUserStore()
        return {authStore}
    },
}
</script>

<style scoped>

</style>
