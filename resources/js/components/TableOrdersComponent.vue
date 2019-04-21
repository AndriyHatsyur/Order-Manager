<template>
    <div class="container-fluid">
      <form-component></form-component>
        <div class="row control">
            <div class="col-sm-6">
                <i class="material-icons btn-success" title="add new order" data-toggle="modal" data-target="#addOrder">add</i>
                
            </div>
        </div>
        <table class="table table-bordered  table-hover table-light">
            <thead>
            <tr>
                <th scope="col" v-for="item in headers">{{item.text}}</th>
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

  export default {

    components: {

      'form-component': Form,
        'row-component': Row,

    },
    data () {
      return {
        headers: [

          {text: '#', value: 'num'},
          {text: 'Teil-numme', value: 'teil'},

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

      }

    },

    computed: {
    
    orders: function () {
     
      return this.$store.getters.getAlltOrders;
    }
  },

    created()  {
      this.$store.dispatch('loadOrders');
      
    },
  }
</script>

<style scoped>
  i {
    font-size: 2em;
    cursor: pointer;
  }
  .control {
    padding: 10px;
  }

</style>