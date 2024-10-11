import {createRouter, createWebHistory} from "vue-router"
import Login from "@/components/user/Login.vue";
import Register from "@/components/user/Register.vue";
import Dashboard from "@/components/admin/Dashboard.vue";
import AdminLayout from "@/components/layouts/AdminLayout.vue";
import UserLayout from "@/components/layouts/UserLayout.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/admin',
            component: AdminLayout,
            children: [
                { path: '', component: Dashboard, name: 'admin.index' }
            ]
        },
        {
            path: '/',
            component: UserLayout,
            children: [
                { path: 'login', component: Login, name: 'user.login' },
                { path: 'register', component: Register, name: 'user.register' },
            ]
        },
        // TODO: make 404 component and load it
        {
            path: '/:pathMatch(.*)',
            component: Dashboard,
            name: '404'
        }
    ]
})

router.beforeEach((to, from) => {
    let access_token = localStorage.getItem('access_token')

    if (!access_token) {
        if (to.name === 'admin.index') {
            return {
                name: 'user.login'
            }
        }
    } else {
        if (to.name === 'user.login') {
            // TODO: change to main page
            return {
                name: 'admin.index'
            }
        }
    }
})

export default router
