import {createRouter, createWebHistory} from "vue-router"
import Login from "@/components/User/Login.vue";
import Index from "@/components/Index.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            component: Index,
            name: 'index'
        },
        {
            path: '/login',
            component: Login,
            name: 'user.login'
        }
    ]
})

export default router
