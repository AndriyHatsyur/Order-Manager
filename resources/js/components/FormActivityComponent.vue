<template>
    <div class="modal fade" id="addActivity" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create new activity</h5>
                    <button @click="" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Group select</label>
                            <select v-model="post.group" class="form-control" >
                                <option value="Dispatcher">Dispatcher</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input v-model="post.title" type="text" class="form-control" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <textarea v-model="post.description" class="form-control" rows="3"></textarea>
                        </div>

                        <button  @click.prevent="" class="btn btn-primary" data-dismiss="modal">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FormActivityComponent",

        data: () =>({
            post: {
                title: '',
                group: '',
                description: ''
            }

        })
    }
</script>

<style scoped>

    button, input, select, .modal-content {
        border-radius: 0 !important;
    }

    button:focus, .btn  {
        text-decoration: none;
        outline:none;
        border: none;
        box-shadow: none;
        border-radius: 0;
    }

</style>