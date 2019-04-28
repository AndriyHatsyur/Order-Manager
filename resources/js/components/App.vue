<template>
        <div>
                <header-component></header-component>
                <router-view></router-view>
        </div>

</template>

<script>
        import Header from './HeaderComponent.vue'
    export default {
        name: "App",
        components: {
            'header-component': Header
        },

            created()  {
                    const user = window.JSON.parse(localStorage.getItem('user'));

                    this.$store.commit('setUser', user);

                    if(!this.$store.getters.isUserLogin)
                            this.$router.push('/login');

            },


    }


</script>

<style scoped>

</style>