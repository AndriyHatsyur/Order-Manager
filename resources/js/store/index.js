import Vue from 'vue'
import Vuex from 'vuex'
import user from './user'
import orderForm from './orderForm'
import orders from './orders'
import ads from './ads'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user, orderForm, orders, ads
    }
})