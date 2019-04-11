<template>
    <tr v-bind:class="{ child: order.parent_id }">
                    <th scope="row" v-on:click='getId' >{{order.id}}</th>
                    <td>{{order.teil}}</td>
                    <td>{{order.user.t_number}}</td>
                    <td>{{order.created_at}}</td>
                    <td>{{order.group.name}}</td>
                    <td></td>
                </tr>
</template>

<script>
export default {

    props: ['order'],


    methods:{
            getId:function(){
                
            console.log(this.order);
                       
            }       
                   
                   
        }
}
</script>

<style>

.child, .child:hover {
    color: red !important;
}



</style>