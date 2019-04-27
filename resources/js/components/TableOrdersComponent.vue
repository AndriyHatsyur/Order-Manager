<template>
    <div class="container-fluid">
      <form-component></form-component>
        <div class="row control">
            <div class="col-sm-6">
                <button class="material-icons btn-success" title="add new order" data-toggle="modal" data-target="#addOrder">add</button>
                <button @click="allOrders">All</button>
                <button @click="userGroupOrders">{{userGroupName}}</button>
            </div>
            <div class="col-sm-6 right">
                <input v-model="params" @keyup.enter="search" type="text" placeholder="Search">
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

          params: ''
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
              this.$store.commit('userGroupOrders', this.userGroupId);
        },

          allOrders:function () {
              this.$store.commit('allOrders');
          }

      }

  }
</script>

<style scoped>
 
  .control {
    padding: 10px;
  }

  .container-fluid {
      background-color: #cccccc;
      min-height: 90vh;
  }

  .table {
        background: rgba(255,255,255,1);
    }

  button{
        padding: 0;
        border: 0;
        font-size: 2em;
    }  

    .right{
        position: relative;
    }

    input{
        position: absolute;
        right: 5px;
    }
</style>