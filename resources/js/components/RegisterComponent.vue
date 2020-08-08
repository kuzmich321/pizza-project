<template>
    <div class="container">
        <form autocomplete="off" @submit.prevent="register" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="form.email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="form.password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        data(){
            return {
                form: {
                    email: '',
                    password: '',
                }
            };
        },
        methods: {
            ...mapActions({
               registerAction: 'auth/register'
            }),

            register() {
                this.registerAction(this.form).then(() => {
                    this.$router.push('/')
                }).catch((e) => {
                    console.log(e.response.data.errors)
                })
            }
        }
    }
</script>

<style scoped>

</style>
