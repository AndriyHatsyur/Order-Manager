<template>
    <v-toolbar>
        <v-toolbar-title>ORDER MANAGER</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn v-for="link in links" :to="link.url" :key="link.title" flat>{{link.title}}</v-btn>
            <v-btn links v-on:click="logout"> Logout </v-btn>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
    export default {
        name: "HeaderComponent",
        data () {
            return {
                links: [
                    {title:'Orders', icon:'', url:'/orders'},
                    {title:'Group', icon:'', url:'/group'},
                    {title:'Login', icon:'', url:'/login'},
                ]
            }
        },

        methods:{
            logout:function(){
                axios.get('/app/logout')
                    .then(response => {
                        localStorage.removeItem('user');
                        location.reload();
                    })
                    .catch(e => {})
            },
        }
    }
</script>

<style scoped>

</style>