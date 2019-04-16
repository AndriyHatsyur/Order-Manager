<template>
    <v-app >
        <header-component></header-component>
        <router-view></router-view>
    </v-app>
</template>

<script>

    import Header from './HeaderComponent.vue'
    export default {
        name: "App",
        components: {
            'header-component': Header
        },

        created()  {

            //this.$router.push('/login');

        },
    }
</script>

<style scoped>



</style>