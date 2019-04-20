<template>
    
</template>

<script>
    export default {
        name: "LoginComponent",

        data:function(){
            return{
                post: {
                    t_number: '',
                    password: '',
                    remember: 1
                }
            }
        },

        methods:{
            login:function(){
                axios.post(`/app/login`, this.post)
                    .then(response => {

                        const parsed = JSON.stringify(response.data.user);
                        localStorage.setItem('user', parsed);

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