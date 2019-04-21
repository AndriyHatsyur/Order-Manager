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

         loginUser (context, data){

            axios.post(`/app/login`, data)
                .then(response => {

                    const parsed = JSON.stringify(response.data.user);
                    localStorage.setItem('user', parsed);

                    context.commit('setUser', response.data.user);

                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.token;

                })

                .catch(e => {})
        },

        logout(context){

            context.commit('setUser', null);

            localStorage.removeItem('user');

        }


    }

}