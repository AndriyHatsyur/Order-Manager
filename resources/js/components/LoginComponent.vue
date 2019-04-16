<template>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar dark color="blue-grey">
                    <v-toolbar-title>Логування<v-icon>fas fa-lock</v-icon></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                            <v-icon>security</v-icon>
                        </template>
                        <span>Source</span>
                    </v-tooltip>
                    <v-tooltip right>
                        <span>Codepen</span>
                    </v-tooltip>
                </v-toolbar>
                <v-card-text>
                    <v-form color="blue-grey">
                        <v-text-field v-model="post.t_number" prepend-icon="person" name="login" label="Логін" type="text"></v-text-field>
                        <v-text-field v-model="post.password" id="password" prepend-icon="lock" name="password" label="Пароль" type="password"></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn v-on:click="login" color="blue-grey" :dark="true">Вхід</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>
v-model="post.password"
<script>
    export default {
        name: "LoginComponent",

        data:function(){
            return{
                post: {
                    t_number: '',
                    password: ''
                }
            }
        },

        methods:{
            login:function(){
                axios.post(`/app/login`, this.post)
                    .then(response => {

                        const parsed = JSON.stringify(response.data.user);
                        localStorage.setItem('user', parsed);
                        //console.log(JSON.parse(localStorage.getItem('user')));
                        this.$store.state.user = response.data.user;
                        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.token;
                        this.$router.push('/orders');
                    })
                    .catch(e => {})
            },
        }
    }
</script>

<style scoped>

</style>