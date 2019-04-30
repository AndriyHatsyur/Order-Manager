export default {
    state: {
        order: [],
        data: []

    },

    mutations: {
        setOrders(state, value) {
            state.order = state.data = value;
        },

        userGroupOrders(state, userGroupId){
            state.order = state.data.filter(order => {
                return order.group_id == userGroupId;
            });
        },

        allOrders(state){
            state.order = state.data
        },

        search(state, params){

            if(params != '') {
                state.order = state.data.filter(order => {

                    if (String (order.teil).match(params))
                        return order.teil;

                    if (String (order.user.t_number).match(params))
                        return order.user.t_number;

                    if (String (order.status.name).toLocaleLowerCase().match(params))
                        return order.status.name;

                    if (String (order.group.name).toLocaleLowerCase().match(params))
                        return order.group.name;

                    if (String (order.location.name).toLocaleLowerCase().match(params))
                        return order.location.name;

                    if (String (order.reason.name).toLocaleLowerCase().match(params))
                        return order.reason.name;
                })
            } else {
                state.order = state.data
            }

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

    },

    actions: {
        async loadOrders(context) {

            context.commit('setPreloader', true);
            const response = await axios.get(`/app/orders`);
            context.commit('setOrders', response.data);
            context.commit('setPreloader', false);

        },

        zonder(context, order) {
            axios.post(`/app/zonder`, order);
        },

        async success(context, order){

           await axios.post(`/app/orders-success`, order);

           context.dispatch('loadOrders')
        },

        async cancel(context, order){

            await axios.post(`/app/orders-cancel`, order);

            context.dispatch('loadOrders')
        },

        async setTerm(context, order){

            const response = await axios.post(`/app/term`, order);

            return response;
        }



    }

}