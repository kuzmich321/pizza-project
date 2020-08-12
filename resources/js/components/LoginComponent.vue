<template>
    <div class="container">
        <form autocomplete="off" @submit.prevent="login" method="POST">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="form.email"
                       required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="form.password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        data() {
            return {
                form: {
                    email: null,
                    password: null
                }
            }
        },
        methods: {
            ...mapActions({
                signIn: 'auth/login'
            }),

            login() {
                this.signIn(this.form).then(() => {
                    this.$router.replace({
                        name: 'home'
                    }).catch((err) => {
                        console.log(err)
                    })
                })
            }
        }
    }
</script>

<style scoped>

</style>
