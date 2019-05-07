<template>
    <div class="container-fluid">
      <form-order-component></form-order-component>
        <form-activity-component></form-activity-component>
        <div class="row control">
            <div class="col-sm-3 left">
                <button @click="clear" class="material-icons btn-success  add" title="Add new order" data-toggle="modal" data-target="#addOrder">add</button>
                <button :class="{'btn-success': btnAll}" @click="allOrders" class="all btn btn-secondary ">All</button>
                <button :class="{'btn-success': btnUserGroup}" @click="userGroupOrders" class=" user-group btn btn-secondary">{{userGroupName}}</button>

            </div>
            <div class="col-sm-6">
                <span> New: {{newOrders}} ;</span>
                <span> In-Process: {{inProcessOrders}} ;</span>
                <span> In-Transport: {{inTransportOrders}} ;</span>
                <span> No-component: {{noComponentsOrders}} ;</span>
                <span> Incomplete: {{incompleteOrders}} ;</span>
            </div>
            <div class="col-sm-3 right">
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

  import FormOrder from './FormOrderComponent.vue'
  import FormActivity from './FormActivityComponent.vue'
  import Row from './TableOrdersRowComponent.vue'
  import Header from './TableHeaderComponent.vue'

  export default {

    components: {
        'form-order-component': FormOrder,
        'form-activity-component': FormActivity,
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
        },

        newOrders: function () {

            return this.countStatusOrders(100);
        },

        inProcessOrders: function () {

            return this.countStatusOrders(200);
        },

        inTransportOrders: function () {

            return this.countStatusOrders(300);
        },

        noComponentsOrders: function () {
            return this.countStatusOrders(275);
        },

        incompleteOrders: function () {
            return this.countStatusOrders(250);
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
          },

          countStatusOrders: function (statusCode) {

              const arr = this.$store.state.orders.data.filter(order => {
                  return order.status.code == statusCode;
              });

              return arr.length;
          },

          clear: function(){
              this.$store.state.orderForm.post.parent = null;
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
        max-width: 80%;
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