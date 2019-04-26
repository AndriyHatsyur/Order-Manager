<template>
    <th scope="col">
        <span @click="clearSort">{{item.text}}</span>
        <i
                v-if="item.text != 'Control'"
                @click="sort(1, -1, item.value , true)"

                class="material-icons up"
                :class="{ 'black': sortUp}"
        >
            arrow_drop_up
        </i>
        <i
                v-if="item.text != 'Control'"
                @click="sort(-1, 1, item.value,  false)"
                class="material-icons down"
                :class="{ 'black': sortDown}"
        >
            arrow_drop_down
        </i>

    </th>
</template>

<script>
    export default {
        name: "TableHeaderComponent",
        props:['item'],

        data () {
            return {
                sortUp: false,
                sortDown: false,
            }
        },

        methods:{
            sort: function (v1, v2, value, upOrDown) {
                this.sortUp = upOrDown;
                this.sortDown = !upOrDown;
                this.$store.commit('sortOrders', {a:v1, b:v2, value:value});
            },

            clearSort: function () {
                this.sortUp = false;
                this.sortDown = false;
                this.$store.commit('sortOrders', {a:1, b:-1, value:'count'});
            }
        }
    }
</script>

<style scoped>

    th {
        position: relative;
    }

    i {
        position: absolute;
        right: 0;
        cursor: pointer;
        color: #ccccb3;
    }

    span {
        cursor: pointer;
    }

    i:hover{
        color: black;
    }

    .black {
        color: black;
    }

    .up{

        top: 3px;
    }

    .down{
        bottom: 3px;
    }

</style>