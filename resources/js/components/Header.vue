<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand">
                <router-link :to="{ name: 'home' }" class="nav-link">Pizza</router-link>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <template v-if="!authenticated">
                        <li class="nav-item">
                            <router-link :to="{ name: 'login' }" class="nav-link">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'register' }" class="nav-link">Register</router-link>
                        </li>
                    </template>
                    <li class="nav-item" v-if="authenticated">
                        <a href="" class="nav-link" @click.prevent="logout">Logout</a>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'card' }" class="nav-link">My Card</router-link>
                    </li>
                    <li class="nav-item" v-if="authenticated">
                        <router-link :to="{ name: 'history' }" class="nav-link">History</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "Header",
        computed: {
            ...mapGetters({
                authenticated: 'auth/authenticated',
                user: 'auth/user'
            })
        },

        methods: {
            ...mapActions({
                logoutAction: 'auth/logout'
            }),

            logout() {
                this.logoutAction().then(() => {
                   this.$router.go(0).catch(() => {});
                });
            }
        }
    }
</script>

<style scoped>

</style>
