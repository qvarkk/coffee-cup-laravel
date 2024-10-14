import {createRouter, createWebHistory} from "vue-router"
import Login from "@/components/user/Login.vue";
import Register from "@/components/user/Register.vue";
import Dashboard from "@/components/admin/Dashboard.vue";
import AdminLayout from "@/components/layouts/AdminLayout.vue";
import UserLayout from "@/components/layouts/UserLayout.vue";
import Homepage from "@/components/user/Homepage.vue";
import {getCurrentUser} from "@/api/users.js";
import CategoriesIndex from "@/components/admin/Categories/Index.vue";
import ProductsIndex from "@/components/admin/Products/Index.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/admin',
            component: AdminLayout,
            children: [
                { path: '', component: Dashboard, name: 'admin.index' },
                { path: 'categories', component: CategoriesIndex, name: 'admin.categories' },
                { path: 'products', component: ProductsIndex, name: 'admin.products' },
            ],
            meta: { requiresAuth: true, requiresAdmin: true },
        },
        {
            path: '/',
            component: UserLayout,
            children: [
                { path: 'login', component: Login, name: 'user.login' },
                { path: 'register', component: Register, name: 'user.register' },
                { path: '', component: Homepage, name: 'user.index' },
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

router.beforeEach(async (to, from) => {
    let access_token = localStorage.getItem('access_token')

    if (to.meta.requiresAdmin) {
        const user = await getCurrentUser();
        if (user.data.role !== 2) {
            return {
                name: 'user.index'
            }
        }
    }

    if (to.meta.requiresAuth && !access_token) {
        return {
            name: 'user.login'
        }
    } else if (!to.meta.requiresAuth && access_token) {
        if (to.name === 'user.login' || to.name === 'user.register') {
            return {
                name: 'user.index'
            }
        }
    }
})

export default router
