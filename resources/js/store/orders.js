export default {
    state: {
        order: [],

    },

    mutations: {
        setOrders(state, value) {
            state.order  = value;
        }
    },

    getters: {
        getAlltOrders: state => {
          return state.order;
        },

        getMytOrders: state => {
            return state.order.filter(orde => orde.id < 20);
          }
    },

    actions: {
        loadOrders(context) {
            
            axios.get(`/app/orders`)
                .then(response => {  
                    context.commit('setOrders', response.data);
                })
                .catch(e => {})

        },



    }

}