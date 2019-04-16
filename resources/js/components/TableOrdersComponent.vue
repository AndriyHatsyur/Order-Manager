<template>
  <v-card>
      <v-card-title >
        <v-btn  fab small dark color="success" >
          <v-icon  dark>add</v-icon>
        </v-btn>
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
      <td class="text-xs-left" :class="{ child: props.item.parent_id }">1</td>
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
  export default {
    data () {
      return {
        headers: [
          {
            text: 'Teil-nummer',
            align: 'left',
            sortable: false,
            value: 'teil'
          },
          { text: 'User', value: 'user.t_number' },
          { text: 'Create', value: 'created_at' },
          { text: 'Croup', value: 'group.name' },
          { text: 'Location', value: 'group.name' },
          { text: 'Control' },

        ],

        orders: [],
        search: '',

      }

    },

    created()  {

      axios.get('/app/orders')
              .then(response => {

                this.orders = response.data;

              })
              .catch(e => {

              })

    },


    methods:{



    }


  }
</script>

<style scoped>

  .child, .child:hover {
    color: red !important;
  }
</style>