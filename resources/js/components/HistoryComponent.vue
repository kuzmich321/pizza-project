<template>
    <div class="container">
        <div class="jumbotron jumbotron-fluid h-50" v-for="order in orders">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-8 d-flex justify-content-around">
                        <div v-for="item in order.order_items">
                            <img class="pizza card-img mb-3" :src="`https://laravel-blog-1337.s3.eu-north-1.amazonaws.com/pizzas/pizza-${item.pizza.id}.svg`">
                            <p class="text-secondary text-center">{{item.pizza.name}}</p>
                            <p class="text-secondary text-center">Quantity - {{item.quantity}}</p>
                        </div>
                    </div>
                </div>
                <p class="lead text-center">{{order.city}}, {{order.street}}, house: {{order.house}}, apartment:
                    {{order.apartment}}</p>
                <h5 class="lead text-right text-primary">Total: {{order.total}}</h5>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "HistoryComponent",
        data() {
            return {}
        },
        computed: {
            ...mapGetters({
                orders: 'order/history'
            })
        },
        methods: {
            ...mapActions({
                getHistory: 'order/getHistory'
            }),
        },
        mounted() {
            this.getHistory()
        }
    }
</script>

<style scoped>

</style>
