<template>
    
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