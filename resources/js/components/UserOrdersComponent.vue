<template>
    <div class="container-fluid">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">Teil-numme</th>
                <th scope="col">Status</th>
                <th scope="col">Croup</th>
                <th scope="col">Location</th>
                <th scope="col">Reason</th>
                <th scope="col">Term</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="order in userOrders">
                <tr :class="{'table-danger' : order.status.code == 500,
                             'table-success' : order.status.code == 400,
                             'table-warning' : order.status.code == 275,
                             'table-primary' : order.status.code == 300
                    }"


                >
                    <td>{{order.teil}}</td>
                    <td>{{order.status.name}}</td>
                    <td>{{order.group.name}}</td>
                    <td>{{order.location.name}}</td>
                    <td>{{order.reason.name}}</td>
                    <td v-if="order.term !=null">{{order.term.substring(0,16)}}</td>
                    <td v-else>{{order.term}}</td>
                </tr>
            </template>


            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "UserOrdersComponent",
        data () {
            return {
                userOrders: []
            }
        },

        created() {
            this.$store.commit('setPreloader', true);
            axios.get(`/app/user-orders`).then(response => {
                this.userOrders = response.data;
                this.$store.commit('setPreloader', false);
            });

        }
    }
</script>

<style scoped>

    .container-fluid {
        background-color: #cccccc;
        min-height: 90vh;
        padding-top:20px;
    }

    .table {
        background: rgba(255,255,255,1);

    }


</style>