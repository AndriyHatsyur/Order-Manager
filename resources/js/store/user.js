export default {
    state: {
        user: null,

    },
    mutations: {
        setUser (state, user) {

            state.user = user;
        }
    },

    getters: {

        isUserLogin(state) {

            return state.user != null;
        },

        userGroupName(state){
            return state.user.group.name;
        },

        userGroupId(state){
            return state.user.group_id;
        }


    },

    actions: {

        async loginUser (context, data){

           const response = await axios.post(`/app/login`, data);

           const parsed = await JSON.stringify(response.data.user);

           localStorage.setItem('user', parsed);

           context.commit('setUser', response.data.user);

           window.axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.token;

        },

        logout(context){

            context.commit('setUser', null);

            localStorage.removeItem('user');

        },

    }

}