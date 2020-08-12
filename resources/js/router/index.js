import Vue from 'vue';
import VueRouter from 'vue-router';

import CardComponent from "../components/CardComponent";
import PizzasComponent from "../components/PizzasComponent";
import LoginComponent from "../components/LoginComponent";
import RegisterComponent from "../components/RegisterComponent";
import HistoryComponent from "../components/HistoryComponent";

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
            component: RegisterComponent
        },
        {
            name: 'login',
            path: '/login',
            component: LoginComponent
        },
        {
            name: 'history',
            path: '/history',
            component: HistoryComponent
        }
    ],
    mode: 'history'
})
