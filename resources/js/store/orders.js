export default {
    state: {
        order: [],

    },

    mutations: {
        setOrders(state, value) {
            state.order  = value;

        },

        sortOrders(state, value) {

            let param = value.value.split('.');
            if (param.length == 2)
            {
                state.order.sort((a, b) => {

                    if (a[param[0]][param[1]] > b[param[0]][param[1]])
                        return value.a;
                    if (a[param[0]][param[1]] < b[param[0]][param[1]])
                        return value.b;
                });
            }
            else {

                state.order.sort((a, b) => {

                    if (a[param[0]] > b[param[0]])
                        return value.a;
                    if (a[param[0]] < b[param[0]])
                        return value.b;
                });
            }

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
        async loadOrders(context) {

            const response = await axios.get(`/app/orders`)
            context.commit('setOrders', response.data);

        },



    }

}