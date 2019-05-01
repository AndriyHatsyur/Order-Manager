<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <input v-model="data.t_number" type="text" class="form-control" >
            </div>
            <div class="col-sm-3">
                <select v-model="data.group" class="form-control" >
                    <option value="Dispatcher">Dispatcher</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select v-model="data.location" class="form-control">
                    <option value="F2">F2</option>
                    <option value="X1">X1</option>
                    <option value="F1">F1</option>
                    <option value="F5">F5</option>
                    <option value="F7">F7</option>
                </select>
            </div>
            <div class="col-sm-1">
                <button @click="create"> Create</button>
            </div>
        </div>
        <br>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">User</th>
                <th scope="col">Group</th>
                <th scope="col">Location</th>
                <th scope="col">Admin</th>
                <th scope="col">Control</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="user in users">
                <tr>
                    <td>{{user.t_number}}</td>
                    <td>
                        <select v-model="user.group.name" class="form-control" >
                            <option value="Dispatcher">Dispatcher</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </td>
                    <td>
                        <select v-model="user.location.name" class="form-control">
                            <option value="F2">F2</option>
                            <option value="X1">X1</option>
                            <option value="F1">F1</option>
                            <option value="F5">F5</option>
                            <option value="F7">F7</option>
                        </select>
                    </td>
                    <td class="input-field">
                        <input v-model="user.roles.is_admin" type="checkbox" class="form-check-input">
                    </td>
                    <td><button @click="save(user)">Save</button></td>

                </tr>
            </template>


            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "UsersComponent",
        data () {
            return {
                data: {
                    t_number: '',
                    group: '',
                    location: ''
                },

                users:[]
            }
        },

        created() {
            this.$store.commit('setPreloader', true);
            axios.get(`/app/admin/users`).then(response => {
                this.users = response.data;
                this.$store.commit('setPreloader', false);
            });

        },

        methods: {
            save:function (user) {
                const data = {
                    id: user.id,
                    group: user.group.name,
                    location: user.location.name,
                    is_admin: user.roles.is_admin
                }

                axios.post('/app/admin/user-update', data);
            },

            create: function () {

                console.log(this.data)
                axios.post('/app/admin/user', this.data).then(()=>{
                    this.data.t_number = '';
                });

            }
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

    .input-field {
        text-align: center;
    }


</style>