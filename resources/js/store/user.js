import router from './../routes'
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

        isUserAdmin(state){
            if(state.user != null)
                return state.user.roles.is_admin;
            return false
        },

        isUserSuperAdmin(state){
            if(state.user!= null)
                return state.user.roles.is_super_admin;
            return false
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

            try {
                const response = await axios.post(`/app/login`, data);

                const parsed = await JSON.stringify(response.data.user);

                localStorage.setItem('user', parsed);

                context.commit('setUser', response.data.user);

                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.token;

                if (response.status == 200)
                    router.push('/orders');

            }catch (e) {

                alert('Wrong login or password ' + e.message);
            }

        },

        logout(context){

            context.commit('setUser', null);

            localStorage.removeItem('user');

        },

    }

}