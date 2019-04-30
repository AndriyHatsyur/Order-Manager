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
                    <i class="material-icons" :title="link.title">{{link.icon}}</i>
                </router-link>
                <a v-if="this.$store.getters.isUserLogin" class="nav-item nav-link" href="app/logout" title="Logout" @click="logout"><i class="material-icons">
                    input
                </i></a>
            </div>
        </div>
    </nav>
    
</template>

<script>
    export default {
        name: "HeaderComponent",

        computed:{
          links:function () {

              if (this.$store.getters.isUserLogin){
                  return [
                      {title:'Orders list', icon:'format_list_numbered', url:'/orders'},
                      {title:'User orders', icon:'format_indent_increase', url:'/user-orders'},
                      {title:'History order', icon:' history', url:'/history-order'},
                      {title:'Activities list', icon:'assignment', url:'/activities'},
                      {title:'Settings', icon:'settings', url:'/settings'},



                  ]
              }else{
                  return [
                      {title:'Login', icon:'security', url:'/login'},

                  ]
              }

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
        line-height: 60px;
        padding-left: 30px;
        padding-right: 30px;

    }
    a:hover, .active, navbar-link {
        background-color: darkslategrey;

    }

    .active {
        border-left: 1px solid gray;
        border-right: 1px solid gray;
    }

    .navbar {
        height: 60px;
    }

    i {
        font-size: 1.7em;

    }


</style>