<template>
    <div class="notifications">
        <template v-for="message in stateStore.notifications">
            <Notification :message="message"></Notification>
        </template>
    </div>
</template>


<script>
import Notification from "@/components/user/Notificatons/Notification.vue";
import {useHomepageStateStore} from "@/store/homepageStateStore.js";

export default {
    name: "Notifications",

    components: {Notification},

    setup() {
        const stateStore = useHomepageStateStore()
        return {stateStore}
    },
}
</script>

<style scoped>
.notifications {
    position: fixed;
    display: flex;
    flex-direction: column;
    gap: 5px;
    top: 20px;
    width: 250px;
    left: calc(50vw - 125px);
    z-index: 999999;
}
</style>
