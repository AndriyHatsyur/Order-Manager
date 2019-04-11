<template>
    <div class="container">

        <table class="table table-bordered  table-hover" v-bind:class="{'table-dark': dark }">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">TEIL</th>
              <th scope="col">USER</th>
              <th scope="col">DATE</th>
              <th scope="col">GROUP</th>
              <th scope="col">CONTROL</th>
            </tr>
          </thead>

                <table-body  :orders = "orders"></table-body>

        </table>

    </div>
</template>

<script>

    import TableBody from './TableBodyComponent.vue'
    export default {

        components: {
            'table-body': TableBody
        },

        data:function(){
                return{
                    orders: [],
                    data: [],
                    dark: true

                }
            },

            beforeCreate()  {

                axios.get('/orders')
                         .then(response => {

                            this.orders = response.data;
                            console.log(this.orders);
                        })
                        .catch(e => {

                    })


            }

    }
</script>

<style>

</style>
