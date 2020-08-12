import Vue from 'vue';
import Vuex from 'vuex';
import auth from "./auth";
import pizza from "./pizzas";
import card from "./card";
import order from "./order";

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: true,
    state: {},

    mutations: {},

    actions: {},

    modules: {
        auth,
        pizza,
        card,
        order
    }
});
