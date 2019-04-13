
import VueRouter from 'vue-router'

import TableOrdersComponent from './components/TableOrdersComponent.vue'

export default new VueRouter({

    routes: [

        { path: '/', component: TableOrdersComponent},



    ],
    mode: 'history'
})