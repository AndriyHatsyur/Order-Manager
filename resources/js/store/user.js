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

            if (state.user.user != null)
                return state.user.user;

            return false;
        }

    },

    actions: {

        async loginUser (context, data){

           const response = await axios.post(`/app/login`, data);

           const parsed = await JSON.stringify(response.data.user);

           await  localStorage.setItem('user', parsed);

           await context.commit('setUser', response.data.user);

           window.axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.token;

        },

        logout(context){

            context.commit('setUser', null);

            localStorage.removeItem('user');

        }


    }

}