<template>
    <Banner></Banner>
    <div class="container">
        <div class="item-showcase">
            <h3>Новинки</h3>
            <div class="items">
                <template v-if="latest && latest.length > 0" v-for="item in latest">
                    <Item :id="item.id" :name="item.name" :description="item.description" :serving="item.serving"
                          :in_stock="item.in_stock"
                          :price="item.price" :image="item.image"></Item>
                </template>
                <template v-if="latest && latest.length <= 0">
                    <span class="items-empty">Пока что нет товаров... Заходите позднее</span>
                </template>
            </div>
            <div class="items" v-if="latestLoading">
                <InlineLoadingSpinner :size="35" :is-loading="true"></InlineLoadingSpinner>
            </div>
        </div>
        <div class="item-showcase">
            <h3>Популярное</h3>
            <div class="items">
                <template v-if="popular && popular.length > 0" v-for="item in popular">
                    <Item :id="item.id" :name="item.name" :description="item.description" :serving="item.serving"
                          :in_stock="item.in_stock"
                          :price="item.price" :image="item.image"></Item>
                </template>
                <template v-if="popular && popular.length <= 0">
                    <span class="items-empty">Пока что нет товаров... Заходите позднее</span>
                </template>
            </div>
            <div class="items" v-if="popularLoading">
                <InlineLoadingSpinner :size="35" :is-loading="true"></InlineLoadingSpinner>
            </div>
        </div>
    </div>
    <AboutUs></AboutUs>
</template>

<script>
import Banner from "@/components/user/Homepage/Banner.vue";
import Item from "@/components/user/Homepage/Item.vue";
import {getLatestProducts, getPopularProducts} from "@/api/products.js";
import InlineLoadingSpinner from "@/components/common/InlineLoadingSpinner.vue";
import AboutUs from "@/components/user/Homepage/AboutUs.vue";
import {useUserStore} from "@/store/authStore.js";

export default {
    name: "Homepage",

    setup() {
        const authStore = useUserStore()
        return {authStore}
    },

    data() {
        return {
            popular: null,
            latest: null,
            popularLoading: true,
            latestLoading: true,
        }
    },

    components: {
        AboutUs,
        InlineLoadingSpinner,
        Banner,
        Item
    },

    async mounted() {
        this.latest = (await getLatestProducts()).data.data
        this.latestLoading = false
        this.popular = (await getPopularProducts()).data.data
        this.popularLoading = false
    }
}
</script>

<style scoped>
h3 {
    font-size: 25px;
}

.item-showcase {
    padding: 50px 0;
    display: flex;
    flex-direction: column;
    gap: 50px;
}

.items {
    display: flex;
    justify-content: center;
    column-gap: 30px;
    row-gap: 50px;
    flex-wrap: wrap;
}

.items-empty {
    font-size: 20px;
    font-weight: 600 !important;
}

@media (max-width: 1115px) {
    .item-showcase {
        align-items: center;
    }
}
</style>
