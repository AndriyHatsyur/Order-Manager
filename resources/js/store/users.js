export default {
    state: {
        users: []
    },

    mutations: {

        setUsers  (state, data) {
            state.users = data;
        }
    },

    getters: {

        getAllUsers(state){

            return state.users;
        }
    },

    actions: {

        async loadUsers(context){

            context.commit('setPreloader', true);
            const response = await axios.get(`/app/admin/users`);

            context.commit('setUsers', response.data);
            context.commit('setPreloader', false);

        },

        async createUser(context, user){

            await axios.post('/app/admin/user', user);

            context.dispatch('loadUsers');
        },

        async updateUser(context, user){

            await axios.post('/app/admin/user-update', user);

            context.dispatch('loadUsers');
        },

        async deleteUser(context, user){

             const r = await axios.post('/app/admin/user', user);

            console.log(r.data)
            context.dispatch('loadUsers');
        },
    }
}