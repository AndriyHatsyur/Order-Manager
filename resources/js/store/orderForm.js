export default {
    state: {
        post: {
            location: '',
            teil: '',
            group: '',
            reason: '',
            zonder: false,
            parent: null,
            transport: null
        },

    },

    mutations: {
        setValueOrderForm(state, value) {
            state.post.location = value.location;
            state.post.teil     = value.teil;
            state.post.group    = value.group;
            state.post.reason   = value.reason;
            state.post.zonder   = value.zonder;
            state.post.transport   = value.transport;
        },

        clearValueOrderForm(state, value) {
            state.post.location = '';
            state.post.teil     = '';
            state.post.group    = '';
            state.post.reason   = '';
            state.post.zonder   = false;
            state.post.parent   = null;
            state.post.transport   = null;
        }
    },

    actions: {
       async sendOrderForm(context, value) {

            await context.commit('setValueOrderForm', value);

            await axios.post(`/app/orders`, context.state.post);

            context.commit('clearValueOrderForm');

            
        },

        
    }

}