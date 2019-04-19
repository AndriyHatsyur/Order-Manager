<template>
  <v-card>
    <loader-component></loader-component>
      <v-card-title >
        <form-component :dialog="dialog" :parent_id="parent_id"></form-component>
        <v-spacer></v-spacer>
        <v-text-field
                v-model="search"
                append-icon="search"
                label="Search"
                single-line
                hide-details
        ></v-text-field>
    </v-card-title>
  <v-data-table
    :headers="headers"
    :items="orders"
    :search="search"
    :rows-per-page-items="[100,25,50,{'text':'$vuetify.dataIterator.rowsPerPageAll','value':-1}]"
    class="elevation-1"
  >
    <template v-slot:items="props" >
      <td :class="{ child: props.item.parent_id }">{{ props.item.num }}</td>
      <td :class="{ child: props.item.parent_id }">{{ props.item.teil }}</td>

      <td class="text-xs-left" :class="{ child: props.item.parent_id }">{{ props.item.user.t_number }}</td>
      <td class="text-xs-left" :class="{ child: props.item.parent_id }">{{ props.item.status.code }}</td>
      <td class="text-xs-left" :class="{ child: props.item.parent_id }">{{ props.item.created_at}}</td>
      <td class="text-xs-left" :class="{ child: props.item.parent_id }">{{ props.item.group.name }}</td>
      <td class="text-xs-left" :class="{ child: props.item.parent_id }">{{ props.item.location.name }}</td>
      <td class="text-xs-left" :class="{ child: props.item.parent_id }">{{ props.item.reason.name }}</td>
      <td v-if="props.item.term" class="text-xs-left" :class="{ child: props.item.parent_id }">{{ props.item.term }}</td>
      <td v-else class="text-xs-left" :class="{ child: props.item.parent_id }">

        <v-flex xs12 sm2>
          <v-select
                  v-model="props.item.term"
                  :items="[{text: '1 ', value: 1}, {text: '2', value: 2}, {text: '3', value: 3} ]"
                  @input="setTerm(props.item)"

          ></v-select>
        </v-flex>


      </td>
      <td class="text-xs-left">

        <v-btn v-if="props.item.zonder"flat icon color="success" @click="zonder(props.item)">
          <v-icon>local_shipping</v-icon>
        </v-btn>
        <v-btn v-else flat icon color="" @click="zonder(props.item)">
          <v-icon>local_shipping</v-icon>
        </v-btn>

      </td>
      <td class="text-xs-left">
        <v-layout row wrap>
          <v-flex xs12 sm3>
            <v-btn flat icon color="success" @click="addChildren(props.item.id)">
              <v-icon>playlist_add</v-icon>
            </v-btn>

          </v-flex>
          <span> &nbsp &nbsp</span>
          <v-flex xs12 sm3>
            <v-btn flat icon color="success" @click="success(props.item.id)">
              <v-icon>check_circle_outline</v-icon>
            </v-btn>
          </v-flex>
          <span> &nbsp &nbsp</span>
          <v-flex xs12 sm3>
            <v-btn flat icon color="error" @click="cancel(props.item.id)">
              <v-icon>cancel</v-icon>
            </v-btn>
          </v-flex>
          <span> &nbsp &nbsp</span>
        </v-layout>
      </td>
    </template>
    <v-alert v-slot:no-results :value="true" color="error" icon="warning">
      Your search for "{{ search }}" found no results.
    </v-alert>
  </v-data-table>
  </v-card>
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