import Vue from 'vue';
import VueRouter from 'vue-router';
import CardComponent from "./components/CardComponent";
import PizzasComponent from "./components/PizzasComponent";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', component: PizzasComponent },
        { path: '/card', component: CardComponent },
    ],
    mode: 'history'
})
