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

                    const user = JSON.parse(localStorage.getItem('user'));
                    this.$store.state.user.user = user;

                    if(this.$store.state.user.user == null)
                            this.$router.push('/login');
            },


    }


</script>

<style scoped>



</style>