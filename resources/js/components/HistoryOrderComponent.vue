<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <input type="text" class="form-control"  v-model="post.teil" @keyup.enter="getHistory" placeholder="Enter teil-nummer" required >
            </div>
            <div class="col-sm-4">
                <button class="btn btn-primary" @click="getHistory">Go</button>
            </div>
            <br><br>
        </div>

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Teil-numme</th>
                    <th scope="col">Status</th>
                    <th scope="col">Croup</th>
                    <th scope="col">Location</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Term</th>
                    <th scope="col">User</th>
                    <th scope="col">Date</th>
                    <th scope="col">Change</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="item in history">
                    <tr>
                        <td>{{String('00000' + item.order.id).slice(-7)}}</td>
                        <td>{{item.order.teil}}</td>
                        <td>{{item.status.name}}</td>
                        <td>{{item.order.group.name}}</td>
                        <td>{{item.order.location.name}}</td>
                        <td>{{item.order.reason.name}}</td>
                        <td v-if="item.order.term != null">{{item.order.term.substring(0,16)}}</td>
                        <td v-else>{{item.order.term}}</td>
                        <td>{{item.user.t_number}}</td>
                        <td>{{item.created_at.substring(0,16)}}</td>
                        <td>{{item.change_name}}</td>
                    </tr>
                </template>


                </tbody>
            </table>

    </div>
</template>

<script>
    export default {
        name: "HistoryOrderComponent",
        data () {
            return {
                history: [],
                post:{
                    teil:'',
                }

            }
        },

        methods: {

            getHistory: function () {
                axios.post(`/app/history-order`, this.post).then(response => {
                    this.history = response.data;
                    this.clear();
                });
            },

            clear: function () {
                this.post.teil = '';
            }
        },

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

    button, input {
        border-radius: 0;
    }

    button:focus, .btn  {
        text-decoration: none;
        outline:none;
        border: none;
        box-shadow: none;
        border-radius: 0;
    }


</style>