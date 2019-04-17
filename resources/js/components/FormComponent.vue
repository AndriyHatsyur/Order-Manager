<template>
    <v-layout row justify-left>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn  fab small dark color="success" v-on="on">
                    <v-icon  dark>add</v-icon>
                </v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Create new order</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12 sm3>
                                <v-select
                                        v-model="post.location"
                                        :items="[{text: 'F2', value: 1}, {text: 'X1', value: 2} ]"
                                        label="Location"
                                        required
                                ></v-select>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="post.teil" label="Teil" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6>
                                <v-select
                                        v-model="post.group"
                                        :items="[{text: 'Dispatcer', value: 1}, {text: 'Transfer', value: 2}]"
                                        label="Group"
                                        required
                                ></v-select>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-select
                                        v-model="post.reason"
                                        :items="[{text: 'Prio1', value: 1}, {text: 'Prio2', value: 2} ]"
                                        label="Reason"
                                        required
                                ></v-select>
                            </v-flex>

                            <v-flex xs12>
                                <v-checkbox v-model="post.zonder" label="Zonder"></v-checkbox>
                            </v-flex>
                        </v-layout>
                    </v-container>

                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
                    <v-btn color="blue darken-1" flat @click="send">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>
<script>
    export default {
        data: () => ({
            valid: false,
            post: {
                location: '',
                teil: '',
                group: '',
                reason: '',
                zonder: false
            },

            dialog: false,


        }),

        methods:{
            send:function(){

                console.log(this.post);
                axios.post(`/app/orders`, this.post)
                    .then(response => {

                        this.dialog = false;
                    })
                    .catch(e => {})
            },
        }
    }
</script>

<style scoped>

</style>