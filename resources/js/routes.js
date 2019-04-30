
import VueRouter from 'vue-router'
import AdminGuard from './admin-guard'
import TableOrdersComponent from './components/TableOrdersComponent.vue'

import LoginComponent from './components/LoginComponent.vue'

import UserOrdersComponent from './components/UserOrdersComponent.vue'

import HistoryOrderComponent from './components/HistoryOrderComponent.vue'

import UsersComponent from './components/UsersComponent.vue'

export default new VueRouter({

    routes: [

        { path: '/orders', component: TableOrdersComponent},
        { path: '/user-orders', component: UserOrdersComponent},
        { path: '/login', component: LoginComponent},
        { path: '/history-order', component: HistoryOrderComponent},
        { path: '/users', component: UsersComponent, beforeEnter: AdminGuard },
        { path: '*', redirect: '/orders'},
    ],
    mode: 'history'
})