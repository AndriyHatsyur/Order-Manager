import Vue from 'vue'
import Vuex from 'vuex'
import user from './user'
import orderForm from './orderForm'
import orders from './orders'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user, orderForm, orders
    }
})