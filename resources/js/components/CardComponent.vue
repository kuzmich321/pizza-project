<template>
    <div class="container">
        <button class="btn btn-secondary float-right mb-4" @click.prevent="isDollars = !isDollars" v-if="form.pizzas.length > 0">Change Currency</button>

        <template v-if="form.pizzas.length > 0">
            <table class="table table-hover mb-5">
                <thead>
                <tr>
                    <th scope="col" class="text-center"></th>
                    <th scope="col" class="text-center">Pizza</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="pizza in form.pizzas">
                        <th scope="row">
                            <img class="pizza card-img" :src="`${pizza.image}`">
                        </th>
                        <td class="text-center align-middle"><h4>{{ pizza.name }}</h4></td>
                        <td class="text-center align-middle">
                            <input type="number" id="quantity" name="quantity"
                                   min="1" max="10" v-model="pizza.quantity" @click="prepareOrder(pizza)">
                        </td>
                        <td class="text-center align-middle" v-if="isDollars">{{ pizza.orderPrice }} $</td>
                        <td class="text-center align-middle" v-else>{{ Math.ceil(pizza.orderPrice * 0.85) }} €</td>
                        <td class="text-center align-middle">
                            <a href="" class="btn btn-danger" @click="removeFromCard(pizza)">Delete</a>
                        </td>
                </tr>
                </tbody>
            </table>
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="text-secondary text-right">Total Price:
                        <span class="text-primary" v-if="isDollars">{{form.total}} $</span>
                        <span class="text-primary" v-else>{{Math.ceil(form.total * 0.85)}} €</span>
                    </h4>
                </div>
            </div>

            <hr class="mb-3"/>

            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="jumbotron">
                        <form action="">
                            <div class="form-group" v-if="!auth">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="city" v-model="form.email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" placeholder="City..." name="city" v-model="form.city">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="street">Street</label>
                                        <input type="text" class="form-control" id="street" placeholder="Street..." name="street" v-model="form.street">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="city">House</label>
                                        <input type="number" class="form-control" id="house" placeholder="House..." name="house" v-model="form.house">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="apartment">Apartment</label>
                                        <input type="number" class="form-control" id="apartment" placeholder="Apartment..." name="apartment" v-model="form.apartment">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary" @click.prevent="createOrder(form)">Make order</button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
        <h4 class="text-center text-secondary" v-else>No pizzas added</h4>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';

    export default {
        name: "CardComponent",
        data() {
            return {
                form: {
                    email: null,
                    city: null,
                    street: null,
                    house: null,
                    apartment: null,
                    total: 0,
                    pizzas: [],
                },
                isDollars: true
            }
        },
        computed: {
            ...mapGetters({
                card: 'card/card',
                totalPrice: 'card/totalPrice',
                auth: 'auth/authenticated'
            }),
        },
        methods: {
            ...mapActions({
                removeFromCardAction: 'card/removeFromCard',
                getFromLocalStorage: 'card/getFromLocalStorage',
                createOrderAction: 'order/createOrder'
            }),

            removeFromCard(pizza) {
                this.removeFromCardAction(pizza)
            },

            createOrder(fields) {
                this.createOrderAction(fields)
            },

            setLocalPizzas() {
                this.form.pizzas = this.card
            },

            prepareOrder(pizza) {
                pizza.orderPrice = pizza.price * pizza.quantity
                this.form.total = 0
                this.form.pizzas.forEach(pizza => this.form.total += pizza.orderPrice)
            },

            setLocalTotalPrice() {
                this.form.total = this.totalPrice
            }
        },
        mounted() {
            this.getFromLocalStorage()
            this.setLocalPizzas()
            this.setLocalTotalPrice()
        },
    }
</script>

<style scoped>

</style>
