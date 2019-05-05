import Vue from 'vue'
import Vuex from 'vuex'
import login from './login'
import orderForm from './orderForm'
import orders from './orders'
import ads from './ads'
import users from './users'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        login, orderForm, orders, ads, users
    }
})