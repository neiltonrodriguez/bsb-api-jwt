import { createRouter, createWebHashHistory } from 'vue-router'
import { useAuth } from './../stores/auth.js'
const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import(/* webpackChunkName: "login" */ '../views/Login.vue'),
        meta: {
            auth: false
        }
    },
    {
        path: '/',
        name: 'dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '../views/Dashboard.vue'),
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'overview',
                component: () => import(/* webpackChunkName: "overview" */ '../views/Overview.vue'),
                meta: { auth: true }
            },
            {
                path: '/loanrequest',
                name: 'loanrequest',
                component: () => import(/* webpackChunkName: "loanrequest" */ '../views/loanrequest/ListLoanRequest.vue'),
                meta: { auth: true }
            }

        ]

    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

router.beforeEach(async (to, from, next) => {
    if (to.meta?.auth) {
        const auth = useAuth()
        if (auth.token) {
            const isAutenticated = await auth.checkToken()
            if (isAutenticated) {
                next()
            } else {
                next({ name: 'login' })
            }
        } else {
            next({ name: 'login' })
        }
    } else {
        next()
    }
})

export default router
