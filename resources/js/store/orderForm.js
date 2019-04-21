export default {
    state: {
        post: {
            location: '',
            teil: '',
            group: '',
            reason: '',
            zonder: false,
            parent: null
        },

    },

    mutations: {
        setValueOrderForm(state, value) {
            state.post.location = value.location;
            state.post.teil     = value.teil;
            state.post.group    = value.group;
            state.post.reason   = value.reason;
            state.post.zonder   = value.zonder;
        },

        clearValueOrderForm(state, value) {
            state.post.location = '';
            state.post.teil     = '';
            state.post.group    = '';
            state.post.reason   = '';
            state.post.zonder   = false;
            state.post.parent   = null; 
        }
    },

    actions: {
        sendOrderForm(context, value) {

            context.commit('setValueOrderForm', value);

            axios.post(`/app/orders`, context.state.post)
                .then(response => {
                    context.commit('clearValueOrderForm');
                })
                .catch(e => {})

            console.log( context.state.post);
            
        },

        
    }

}