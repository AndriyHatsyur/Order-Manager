<template>
    
        <router-view></router-view>
    
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