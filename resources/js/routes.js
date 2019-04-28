
import VueRouter from 'vue-router'

import TableOrdersComponent from './components/TableOrdersComponent.vue'

import LoginComponent from './components/LoginComponent.vue'

import UserOrdersComponent from './components/UserOrdersComponent.vue'

export default new VueRouter({

    routes: [

        { path: '/orders', component: TableOrdersComponent},
        { path: '/user-orders', component: UserOrdersComponent},
        { path: '/login', component: LoginComponent},
    
    ],
    mode: 'history'
})