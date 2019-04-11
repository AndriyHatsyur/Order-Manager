<template>
      <tbody>      
        <row v-for="order in orders" :order="order" :key="order.id"></row>
    </tbody>
</template>

<script>
    import Row from './RowComponent.vue'
    export default {

        components: {
            'row': Row
        },

        props: ['orders'],


    }
</script>

<style>

</style>