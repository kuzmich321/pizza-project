<template>
    <div class="container">
        <h2 class="text-center text-secondary mb-5">Pizzas!</h2>
        <div class="row">
            <div class="col-6 col-sm-12 col-md-6 mb-3" v-for="pizza in pizzas">
                <div class="card z-depth-0">
                    <img class="pizza card-img" :src="`/storage/images/pizza-${pizza.id}.svg`">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h4>{{ pizza.name }}</h4>
                        <h5 class="text-primary">{{ pizza.price }} $</h5>
                        <p class="card-text text-muted">{{ pizza.description }}</p>
                        <button class="btn btn-primary" v-on:click="addPizza(pizza.id)">Add to card</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pizzas: []
            }
        },
        methods: {
            fetch() {
                axios.get('/pizzas')
                    .then(({data: {data}}) => {
                        this.pizzas = data
                    })
                    .catch(err => console.log(err))
            },
            addPizza(id) {
                let card = [];
                if (this.$cookies.get('card')) {
                    card = JSON.parse(this.$cookies.get('card'));
                    this.$cookies.remove('card');
                    card.push(id);
                    this.$cookies.set('card', JSON.stringify(card), '1d');
                } else {
                    card.push(id);
                    this.$cookies.set('card', JSON.stringify(card), '1d');
                }
            }
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
