<template>
  <v-card>
      <v-card-title >
        <form-component></form-component>
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
    :rows-per-page-items="[100,10,25,50,{'text':'$vuetify.dataIterator.rowsPerPageAll','value':-1}]"
    class="elevation-1"
  >
    <template v-slot:items="props" >
      <td :class="{ child: props.item.parent_id }">{{ props.item.teil }}</td>
      <td class="text-xs-left" :class="{ child: props.item.parent_id }">{{ props.item.user.t_number }}</td>
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
      <td class="text-xs-left" :class="{ child: props.item.parent_id }">

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
  export default {

    components: {
      'form-component': Form,
    },
    data () {
      return {
        headers: [
          {
            text: 'Teil-numme',
            align: 'left',
            sortable: false,
            value: 'teil'
          },
          { text: 'User', value: 'user.t_number' },
          { text: 'Create', value: 'created_at' },
          { text: 'Croup', value: 'group.name' },
          { text: 'Location', value: 'location.name' },
          { text: 'Reason', value: 'reason.name' },
          { text: 'Term', value: 'term' },
          { text: 'Control' },

        ],

        orders: [],
        search: '',
        term: ''

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

      }



    }


  }
</script>

<style scoped>

  .child, .child:hover {
    color: red !important;
  }
</style>