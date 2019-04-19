<template>
    <div v-if="loader" class="text-xs-center">
        <v-progress-circular
                :size="50"
                color="primary"
                indeterminate
        ></v-progress-circular>


    </div>
</template>

<script>
    export default {
        name: "LoaderComponent",

        data(){
            return {
                loader: false
            }
        }
    }
</script>

<style scoped>

</style>