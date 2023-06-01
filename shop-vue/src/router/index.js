import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        name: 'some',
        component: () => import('../views/Some.vue')
    },
    {
        path: '/else',
        name: 'else',
        component: () => import('../views/Else.vue')
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
