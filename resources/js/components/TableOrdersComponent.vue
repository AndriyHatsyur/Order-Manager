<template>
    <div class="container-fluid">
      <form-component></form-component>
        <div class="row control">
            <div class="col-sm-6 left">
                <button class="material-icons btn-success  add" title="Add new order" data-toggle="modal" data-target="#addOrder">add</button>
                <button :class="{'btn-success': btnAll}" @click="allOrders" class="all btn btn-secondary ">All</button>
                <button :class="{'btn-success': btnUserGroup}" @click="userGroupOrders" class=" user-group btn btn-secondary">{{userGroupName}}</button>
            </div>
            <div class="col-sm-6 right">
                <input class="form-control" v-model="params" @keyup.enter="search" type="text" placeholder="Search">
            </div>
        </div>
        <table class="table table-bordered  table-hover ">
            <thead>
            <tr>
                <header-component v-for="item in headers" :item="item" :key="item.text"></header-component>
            </tr>
            </thead>
            <tbody>
            <row-component v-for="order in orders" :order="order" :key="order.id"></row-component>

            </tbody>
        </table>
    </div>

</template>

<script>

  import Form from './FormComponent.vue'
  import Row from './TableOrdersRowComponent.vue'
  import Header from './TableHeaderComponent.vue'

  export default {

    components: {
        'form-component': Form,
        'row-component': Row,
        'header-component': Header,

    },
    data () {
      return {
        headers: [
          { text: '#', value: 'count'},
          { text: 'Teil-numme', value: 'teil'},
          { text: 'Users', value: 'user.t_number'},
          { text: 'Status', value: 'status.code' },
          { text: 'Create', value: 'created_at' },
          { text: 'Croup', value: 'group.name' },
          { text: 'Location', value: 'location.name' },
          { text: 'Reason', value: 'reason.name' },
          { text: 'Term', value: 'term' },
          { text: 'Zonder', value: 'zonder' },
          { text: 'Control' },

        ],

          params: '',
          btnAll: true,
          btnUserGroup: false,
      }

    },

    computed: {
        orders: function () {
          return this.$store.getters.getAlltOrders;
        },

        userGroupName: function () {
            return this.$store.getters.userGroupName;
        },

        userGroupId: function () {
            return this.$store.getters.userGroupId;
        }
    },

      created() {
          this.$store.dispatch('loadOrders');
      },

      methods:{

        search:function () {
            this.$store.commit('search', this.params);
        },

          userGroupOrders: function () {
              this.btnUserGroup = true;
              this.btnAll = false;
              this.$store.commit('userGroupOrders', this.userGroupId);
        },

          allOrders:function () {
              this.btnUserGroup = false;
              this.btnAll = true;
              this.$store.commit('allOrders');
          }

      }

  }
</script>

<style scoped>
 
  .control {
      padding: 10px;
      height: 50px;
  }

  .container-fluid {
      background-color: #cccccc;
      min-height: 90vh;
  }

  .table {
        background: rgba(255,255,255,1);
    }

  .material-icons{
        padding: 0;
        border: 0;
        font-size: 2.45em;
    }

    .right, left{
        position: relative;
    }

    input{
        position: absolute ;
        max-width: 50%;
        right: 5px;
        border-radius: 0;
    }


  button:focus, .btn  {
      text-decoration: none;
      outline:none;
      border: none;
      box-shadow: none;
      border-radius: 0;
  }

    .add, .all, .user-group{
        position: absolute;
    }

    .add{

        left: 5px;
    }

    .all {
        left: 45px;
    }

  .user-group {
      left: 90px;
  }


</style>