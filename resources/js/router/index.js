import Vue from 'vue';
import VueRouter from 'vue-router';

import CardComponent from "../components/CardComponent";
import PizzasComponent from "../components/PizzasComponent";
import LoginComponent from "../components/LoginComponent";
import RegisterComponent from "../components/RegisterComponent";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            name: 'home',
            path: '/',
            component: PizzasComponent
        },
        {
            name: 'card',
            path: '/card',
            component: CardComponent
        },
        {
            name: 'register',
            path: '/register',
            component: RegisterComponent,
            meta: {
                auth: false
            }
        },
        {
            name: 'login',
            path: '/login',
            component: LoginComponent,
            meta: {
                auth: false
            }
        }
    ],
    mode: 'history'
})
