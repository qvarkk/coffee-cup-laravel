<template>
    <Banner></Banner>
    <Item name="ЭФИОПИЯ ОРОМИЯ" description="Легкий кофе с нотами персика, цедры лимона и молочного шоколада" :serving="250" :in_stock="10" :price="619" image="https://placehold.co/200x200"></Item>
</template>

<script>
import Banner from "@/components/user/Homepage/Banner.vue";
import Item from "@/components/user/Homepage/Item.vue";

export default {
    name: "Homepage",

    components: {
        Banner,
        Item
    }
}
</script>

<style scoped>

</style>
