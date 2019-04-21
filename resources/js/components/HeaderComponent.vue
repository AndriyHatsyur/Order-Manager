<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand">ORDER MANAGER</span>

        <div class="navbar-link" >
            <div class="navbar-nav">
                <router-link
                        v-for="link in links"
                        class="nav-item nav-link"
                        active-class="active"
                        :to="link.url"
                        :key="link.title"
                                    >
                    {{link.title}}
                </router-link>
                <a class="nav-item nav-link" href="app/logout" title="Logout" @click="logout"><i class="material-icons">
                    input
                </i></a>
            </div>
        </div>
    </nav>
    
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
                this.$store.dispatch('logout');
            },
        }
    }
</script>

<style scoped>

    .navbar-link {
        position: absolute;
        right: 0%;
    }

    .navbar-nav .nav-link  {
        font-size: 1.1em;
        height: 60px;
        line-height: 2.6;
        padding-left: 30px;
        padding-right: 30px;

    }
    a:hover, .active, navbar-link {
        background-color: darkslategrey;

    }

    .navbar {
        height: 60px;
    }

    i {
        font-size: 1.7em;
        padding-top: 7px;
    }


</style>