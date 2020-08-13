<template>
    <div class="container">
        <button class="btn btn-secondary float-right" @click.prevent="isDollars = !isDollars">Change Currency</button>
        <h2 class="text-center text-secondary mb-5">Pizzas!</h2>
        <div class="row">
            <div class="col-6 col-sm-12 col-md-6 mb-3" v-for="pizza in pizzas">
                <div class="card z-depth-0">
                    <img class="pizza card-img" :src="`${pizza.image}`">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h4>{{ pizza.name }}</h4>
                        <h5 class="text-primary" v-if="isDollars">{{ pizza.price }} $</h5>
                        <h5 class="text-primary" v-else>{{ Math.ceil(pizza.price * 0.85) }} €</h5>
                        <p class="card-text text-muted">{{ pizza.description }}</p>
                        <button class="btn btn-primary" v-on:click="addToCard(pizza)">Add to card</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                isDollars: true
            }
        },
        computed: {
            ...mapGetters({
                pizzas: 'pizza/pizzas',
                card: 'card/card'
            })
        },
        methods: {
            ...mapActions({
                fetchAction: 'pizza/fetch',
                addToCardAction: 'card/addToCard'
            }),

            fetch() {
                this.fetchAction()
            },

            addToCard(pizza) {
                this.addToCardAction(pizza)
            },
        },
        mounted() {
            this.fetch();
        },
    }
</script>

<style>
    .pizza {
        width: 100px;
        margin: 40px auto -30px;
        display: block;
        position: relative;
        top: -30px;
    }
</style>
