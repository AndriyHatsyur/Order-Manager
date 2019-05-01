<template>
    <div v-if="preloader" class="preloader">
        <div  class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>


</template>

<script>
    export default {
        name: "PreLoaderComponent",
        
        computed: {

            preloader: function () {
                return this.$store.state.ads.preloader;
            }
        }

    }
</script>

<style scoped>

    .preloader {
        position: absolute;
        z-index: 1000;
        background-color: ghostwhite;
        height: 100%;
        width: 100%;
        text-align: center;
        padding: 25%;
        opacity: 0.6;
        position: fixed;
    }

</style>