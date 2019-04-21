<template>
    <tr :class="{ child: order.parent_id }">
        <th scope="row">{{order.num}}</th>
        <td>{{order.teil}}</td>
        <td>{{order.user.t_number}}</td>
        <td>{{order.status.code}}</td>
        <td>{{order.created_at}}</td>
        <td>{{order.group.name}}</td>
        <td>{{order.location.name}}</td>
        <td>{{order.reason.name}}</td>
        <td>

            <select v-model="order.term" v-if="!order.term" class="form-control" @change="setTerm(order)">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <span v-else>{{order.term}}</span>
        </td>
        <td>
            <i class="material-icons black "
               title="Zonder"
               @click="zonder(order)"
               v-bind:class="{ 'green': order.zonder }"

            >
                local_shipping</i></td>
        <td>
            <i class="material-icons green"
               title="Add order"
               @click="addChildren(order.id)"
               data-toggle="modal" data-target="#addOrder"
            >
                playlist_add</i>

            <i class="material-icons green"
               title="Success"
               @click="success(order.id)"
            >
                check_circle_outline</i>

            <i class="material-icons child"
               title="Cancel"
               @click="cancel(order)"
            >
                cancel</i>
        </td>
    </tr>
    
</template>

<script>
    export default {
        name: "TableOrdersRowComponent",
        props:['order'],

    
        methods:{

            setTerm:function (order) {

                axios.post(`/app/term`, order)
                    .then(response => {
                        this.order.term = response.data.term;
                        this.order.status.code = response.data.status.code;
                    })
                    .catch(e => {})

            },

            cancel: function (order) {

                const post = {
                    id: order.id,
                    _method: 'delete'
                }

                axios.post(`/app/orders`, post)
                    .then(response => {
                        this.$store.dispatch('loadOrders');
                    })
                    .catch(e => {})
            },

            zonder: function (order) {

                axios.post(`/app/zonder`, order)
                    .then(response => {

                        order.zonder = !order.zonder;

                    })
                    .catch(e => {})
            },

            addChildren: function (id) {

                this.$store.state.orderForm.post.parent = id;

            },
            success: function (id) {
                const post = {
                    id: id,

                }

                axios.post(`/app/orders-success`, post)
                    .then(response => {
                        this.$store.dispatch('loadOrders');
                    })
                    .catch(e => {})
            }
        }
    }
</script>

<style scoped>

    .child, .child:hover {
        color: red !important;
    }

   i {
    font-size: 2em;
    cursor: pointer;
    }
    .green {
        color: green !important;
    }

    .black {
        color: #000;
    }

    select {
        width: 50px;
    }

</style>