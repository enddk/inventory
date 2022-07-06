import { createRouter, createWebHistory } from 'vue-router'
import Home from './components/Home.vue'
import Detail from './components/Detail.vue'
import Add from './components/Add.vue'
import User from './components/User.vue'
import Login from './components/Login.vue'
import Signin from './components/Signin.vue'

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/detail/:id',
            name: 'detail',
            component: Detail,
            props: true,
        },
        {
            path: '/add',
            name: 'add',
            component: Add,
        },
        {
            path: '/user',
            name: 'user',
            component: User,
        },
        {
            path: '/signin',
            name: 'signin',
            component: Signin,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
    ]
})