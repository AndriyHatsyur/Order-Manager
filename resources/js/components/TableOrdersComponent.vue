<template>
 
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

          {text: '№', value: 'num'},
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

      cancel: function (id) {

        const post = {
          id: id,
          _method: 'delete'
        }

        axios.post(`/app/orders`, post)
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
</style>