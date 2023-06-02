import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        name: 'main',
        component: () => import('../views/main/Index.vue')
    },
    {
        path: '/products',
        name: 'products',
        component: () => import('../views/product/Index.vue')
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
