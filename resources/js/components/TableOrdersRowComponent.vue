<template>
    <tr :class="{ child: order.parent_id }">
        <th scope="row">{{order.count}}</th>
        <td>{{order.teil}}</td>
        <td>{{order.user.t_number}}</td>
        <td>{{order.status.name}}</td>
        <td>{{order.created_at.substring(0,16)}}</td>
        <td>{{order.group.name}}</td>
        <td>{{order.location.name}}</td>
        <td>{{order.reason.name}}</td>
        <td>
            <select :disabled="order.status.code >= 300" v-model="order.term" v-if="!order.term" class="form-control" @change="setTerm">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <span v-else @click="order.term = null">{{order.term.substring(0,16)}}</span>
        </td>
        <td>
            <i class="material-icons black "
               title="Zonder"
               @click="zonder"
               v-bind:class="{ 'green': order.zonder }"

            >
                local_shipping</i></td>
        <td>
            <button :disabled="order.status.code > 299"
                    :class="{ 'green': order.status.code < 300}"
                    class="material-icons "
                    title="Add order"
                    @click="addChildren"
                    data-toggle="modal" data-target="#addOrder"
            >
                playlist_add</button>
            <button
                    :disabled="order.status.code > 200 && order.status.code < 300"
                    :class="{ 'green': order.status.code <= 200 || order.status.code >= 300 }"
                    class="material-icons"

                    title="Success"
                    @click="success"
            >
                check_circle_outline</button>
            <button
                    class="material-icons "
                    :disabled="order.status.code > 200 && order.status.code < 300"
                    :class="{ 'child': order.status.code <= 200 || order.status.code >= 300 }"
                    title="Cancel"
                    @click="cancel"
            >
                cancel</button>

            <button
                    class="material-icons "
                    :disabled="order.status.code > 299"
                    :class="{ 'btn-activity': order.status.code < 300 }"
                    title="Add activity"
                    @click=""
                    data-toggle="modal" data-target="#addActivity"
            >
                add_box</button>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "TableOrdersRowComponent",

        props:['order'],

        methods:{
            setTerm:function () {
                this.$store.dispatch('setTerm', this.order).then(response =>{
                    this.order.term = response.data.term;
                    this.order.status.name = response.data.status.name;
                })
            },

            cancel: function () {

                this.$store.dispatch('cancel', this.order);
            },

            zonder: function () {

                this.$store.dispatch('zonder', this.order).then(()=>{
                    this.order.zonder = !this.order.zonder;
                })
            },

            addChildren: function () {

                this.$store.state.orderForm.post.parent = this.order.id;

            },
            success: function () {
                this.$store.dispatch('success', this.order);
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

    .btn-activity {
        color: yellowgreen !important;
    }

    select {
        width: 50px;
    }

    button{
        padding: 0;
        border: none;
        background: none;
    }

    button:focus  {
        text-decoration: none;
        outline:none;
        border: none;
        box-shadow: none;
        border-radius: 0;
    }





</style>