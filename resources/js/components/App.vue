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


    }
</script>

<style scoped>



</style>