
import VueRouter from 'vue-router'

import TableOrdersComponent from './components/TableOrdersComponent.vue'

import LoginComponent from './components/LoginComponent.vue'

export default new VueRouter({

    routes: [

        { path: '/orders', component: TableOrdersComponent},
        { path: '/login', component: LoginComponent},
    
    ],
    mode: 'history'
})