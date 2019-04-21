<template>
    <div class="modal fade" id="addOrder" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create new order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form>

            <div class="form-group">
              <label>Location</label>
              <select v-model="post.location" class="form-control" >
                <option value="1">F2</option>
                <option value="2">X1</option>
              </select>
            </div>
            <div class="form-group">
              <label> Teil</label>
              <input v-model="post.teil" type="text" class="form-control" placeholder="Enter Teil number">
            </div>
            <div class="form-group">
              <label>Group select</label>
              <select v-model="post.group" class="form-control" >
                <option value="1">Dispatcher</option>
                <option value="2">Transfer</option>
              </select>
            </div>
            <div class="form-group">
              <label>Reason</label>
              <select v-model="post.reason" class="form-control" >
                <option value="1">Prio1</option>
                <option value="2">Prio2</option>
              </select>
            </div>
            <div class="form-group form-check">
                <input v-model="post.zonder" type="checkbox" class="form-check-input">
                <label class="form-check-label" >Zonder</label>
            </div>
            <button  @click.prevent="send" class="btn btn-primary" data-dismiss="modal">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
    export default {
        data: () => ({
            post: {
                location: '',
                teil: '',
                group: '',
                reason: '',
                zonder: false,
                parent: null
            },

        }),

        methods:{
            send:function(){

              this.$store.dispatch('sendOrderForm', this.post );
              this.$store.dispatch('loadOrders');
              this.clear();

            },

            clear: function(){
              this.post.location = '';
              this.post.teil     = '';
              this.post.group    = '';
              this.post.reason   = '';
              this.post.zonder   = false;
              this.post.parent   = null; 
            }
        }
    }
</script>

<style scoped>

</style>