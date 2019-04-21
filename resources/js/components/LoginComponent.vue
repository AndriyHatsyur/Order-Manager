<template>
    <div class="login">
        <form @submit.prevent="login">
            <div class="form-group">
                <label>Personal number</label>
                <input v-model="post.t_number" type="text" class="form-control" placeholder="Enter personal number">

            </div>
            <div class="form-group">
                <label>Password</label>
                <input v-model="post.password" type="password" class="form-control"  placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary" >Submit</button>
        </form>
    </div>
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

                this.$store.dispatch('loginUser', this.post);

                setTimeout( () => {
                    if(this.$store.state.user.user != null)
                        this.$router.push('/orders');
                }, 1000);

            },
        }
    }
</script>

<style scoped>

    .login {
        max-height: 100%;
        width: 100%;
    }

    form {

        width: 500px;
        height: 300px;
        margin: 0 auto;
        padding: 50px;
        margin-top: 10%;
        border: 1px solid grey;
    }

    input, button {
        border-radius: 0 !important;
    }

</style>