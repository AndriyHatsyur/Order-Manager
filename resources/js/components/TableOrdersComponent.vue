<template>
    <div class="container-fluid">
      <form-component></form-component>
        <div class="row control">
            <div class="col-sm-6">
                <button class="material-icons btn-success" title="add new order" data-toggle="modal" data-target="#addOrder">add</button>
                
            </div>
        </div>
        <table class="table table-bordered  table-hover ">
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
 
  .control {
    padding: 10px;
  }

  .container-fluid {
      background-color: grey;
      min-height: 100vh;
  }

  .table {
        background: rgba(255,255,255,1);
    }

  button{
        padding: 0;
        border: 0;
        
        font-size: 2em;
    }  

</style>