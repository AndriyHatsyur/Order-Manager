<template>


    
</template>
<script>
    export default {
        props: ['dialog', 'parent_id'],
        data: () => ({
            valid: false,
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
                this.post.parent = this.parent_id;
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