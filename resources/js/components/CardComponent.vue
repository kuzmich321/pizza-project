<template>
    <div class="container">
        <template v-if="pizzas.length > 0">
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

                <tr v-for="pizza in pizzas">
                        <th scope="row">
                            <img class="pizza card-img" :src="`/storage/images/pizza-${pizza.id}.svg`">
                        </th>
                        <td class="text-center align-middle"><h4>{{ pizza.name }}</h4></td>
                        <td class="text-center align-middle">{{ pizza.quantity }}</td>
                        <td class="text-center align-middle">{{ pizza.orderPrice }}</td>
                        <td class="text-center align-middle">
                            <a href="" class="btn btn-danger" @click.prevent="removeFromCard(pizza)">Delete</a>
                        </td>
                </tr>
                </tbody>
            </table>
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="text-secondary text-right">Total Price: <span class="text-primary">{{totalPrice}}</span>
                    </h4>
                </div>
            </div>

            <hr class="mb-3"/>

            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="jumbotron">
                        <form action="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="city" v-model="form.email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" placeholder="City..." name="city">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="city">Street</label>
                                        <input type="text" class="form-control" id="street" placeholder="Street..." name="street">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="city">House</label>
                                        <input type="number" class="form-control" id="house" placeholder="House..." name="house">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="apartment">Apartment</label>
                                        <input type="number" class="form-control" id="apartment" placeholder="Apartment..." name="apartment">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Make order</button>
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
                    apartment: null
                }
            }
        },
        computed: {
            ...mapGetters({
                pizzas: 'card/card',
                totalPrice: 'card/totalPrice'
            })
        },
        methods: {
            ...mapActions({
                removeFromCardAction: 'card/removeFromCard',
                getFromLocalStorageAction: 'card/getFromLocalStorage'
            }),

            removeFromCard(pizza) {
                this.removeFromCardAction(pizza)
            },

            getFromLocalStorage() {
                this.getFromLocalStorageAction()
            }
        },
        mounted() {
            this.getFromLocalStorage()
        }
    }
</script>

<style scoped>

</style>
