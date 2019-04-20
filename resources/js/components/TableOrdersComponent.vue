<template>
    <div class="container-fluid">
        <div class="row control">
            <div class="col-sm-6">
                <i class="material-icons btn-success" title="add new order">add</i>
            </div>
        </div>
        <table class="table table-bordered  table-hover table-light">
            <thead>
            <tr>
                <th scope="col" v-for="item in headers">{{item.text}}</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="order in orders">
                <tr :class="{ child: order.parent_id }">
                    <th scope="row">{{order.num}}</th>
                    <td>{{order.teil}}</td>
                    <td>{{order.user.t_number}}</td>
                    <td>{{order.status.code}}</td>
                    <td>{{order.created_at}}</td>
                    <td>{{order.group.name}}</td>
                    <td>{{order.location.name}}</td>
                    <td>{{order.reason.name}}</td>
                    <td>{{order.term}}</td>
                    <td>
                        <i class="material-icons"
                           title="Zonder"
                           @click="zonder(order)"
                           v-bind:class="{ 'green': order.zonder }"

                        >
                        local_shipping</i></td>
                    <td>
                        <i class="material-icons green"
                           title="Add order"
                           @click="zonder(order)"
                        >
                            playlist_add</i>

                        <i class="material-icons green"
                           title="Success"
                           @click="success(order.id)"
                        >
                        check_circle_outline</i>

                        <i class="material-icons child"
                           title="Cancel"
                           @click="cancel(order)"
                        >
                            cancel</i>
                    </td>
                </tr>
            </template>

            </tbody>
        </table>
    </div>

</template>

<script>

  import Form from './FormComponent.vue'
  import LoaderComponent from "./LoaderComponent";
  export default {

    components: {
      LoaderComponent,
      'form-component': Form,
      'loader-component': LoaderComponent
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

        orders: [],
        search: '',
        term: '',
        dialog: false,
        parent_id: null

      }

    },

    created()  {

      axios.get('/app/orders')
              .then(response => {

                this.orders = response.data;
                console.log(this.orders);

              })
              .catch(e => {

              })

    },


    methods:{

      setTerm:function (item) {

        const post = {
          id: item.id,
          term: item.term
        }

        axios.post(`/app/term`, post)
                .then(response => {

                  axios.get('/app/orders')
                          .then(response => {

                            this.orders = response.data;
                            console.log(this.orders);

                          })
                          .catch(e => {

                          })

                })
                .catch(e => {})

      },

      cancel: function (order) {

        const post = {
          id: order.id,
          _method: 'delete'
        }

        axios.post(`/app/orders`, post)
                .then(response => {
                  let n = this.orders.indexOf(order);
                  this.orders.splice(n, 1);
                    axios.get('/app/orders')
                        .then(response => {

                            this.orders = response.data;


                        })
                        .catch(e => {

                        })


                })
                .catch(e => {})
      },

      zonder: function (order) {

        axios.post(`/app/zonder`, order)
                .then(response => {

                  order.zonder = !order.zonder;

                })
                .catch(e => {})
      },

      addChildren: function (id) {
        this.parent_id = id;
        this.dialog = true;

        console.log(id);


      },
      success: function (id) {
        const post = {
          id: id,

        }

        axios.post(`/app/orders-success`, post)
                .then(response => {
                  console.log(response.data);
                  axios.get('/app/orders')
                          .then(response => {

                            this.orders = response.data;


                          })
                          .catch(e => {

                          })

                })
                .catch(e => {})
      }



    }


  }
</script>

<style scoped>

  .child, .child:hover {
    color: red !important;
  }

    .control {
        padding: 10px;
    }

    i {
        font-size: 2em;
        cursor: pointer;
    }

    .green {
        color: green;
    }


</style>