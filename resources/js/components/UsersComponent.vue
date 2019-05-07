<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <input v-model="data.t_number" type="text" class="form-control" placeholder="Enter Teil number" >
            </div>
            <div class="col-sm-3">
                <select v-model="data.group" class="form-control">
                    <option value="Dispatcher">Dispatcher</option>
                    <option value="Transfer">Transfer</option>
                    <option value="" disabled selected hidden>Change group</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select v-model="data.location" class="form-control">
                    <option value="F2">F2</option>
                    <option value="X1">X1</option>
                    <option value="F1">F1</option>
                    <option value="F5">F5</option>
                    <option value="F7">F7</option>
                    <option value="" disabled selected hidden>Change location</option>
                </select>
            </div>
            <div class="col-sm-1">
                <button class="material-icons green fs" @click="create"> save</button>
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
                <tr :key="user.id">
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
                    <td>
                        <button class="material-icons green" @click="save(user)">save</button>
                        <button class="material-icons red" @click="deleteUser(user)">delete</button>

                    </td>

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
            }
        },

        computed: {
          users: function () {
              return this.$store.getters.getAllUsers;
          }
        },

        created() {

            this.$store.dispatch('loadUsers');
        },

        methods: {
            save:function (user) {
                const data = {
                    id: user.id,
                    group: user.group.name,
                    location: user.location.name,
                    is_admin: user.roles.is_admin
                }

                this.$store.dispatch('updateUser', data);
            },

            create: async function () {

                await this.$store.dispatch('createUser', this.data);
                this.clear();

            },

           deleteUser: function(user) {
               const data = {
                   id: user.id,
                   _method: 'DELETE'
               }

               this.$store.dispatch('deleteUser', data);
           },

            clear: function () {
                this.data.t_number = '';
                this.data.group = '';
                this.data.location = '';
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

     input, select {
    border-radius: 0 !important;
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

    .green {
        color: green;
    }

    .red {
        color: red;
    }

    .fs {
        font-size: 2.8em;
    }



</style>