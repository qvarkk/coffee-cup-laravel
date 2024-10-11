import {createRouter, createWebHistory} from "vue-router"
import Login from "@/components/User/Login.vue";
import Register from "@/components/User/Register.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/login',
            component: Login,
            name: 'user.login'
        },
        {
            path: '/register',
            component: Register,
            name: 'user.register'
        }
    ]
})

export default router
