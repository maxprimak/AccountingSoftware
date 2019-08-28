<template>
    <div class="text-left">
        <div class="auth-layout-wrap" style="background-image: url(/vue-assets/img/sign_back.jpg)">
            <div class="auth-content">
                <div class="card o-hidden">
                    <div class="row">
                        <div class="col-md-6 text-center " style="background-size: cover;background-image: url(/vue-assets/img/photo-long-3.jpg)">
                            <div class="pl-3 auth-right">
                                <div class="auth-logo text-center mt-4">
                                    <img src="/assets/images/logo.png" alt="">
                                </div>
                                <div class="flex-grow-1"></div>
                                <div class="w-100 mb-4">
                                    <router-link to="/signin">
                                        <span class="btn btn-outline-primary btn-outline-email btn-block btn-icon-text btn-rounded">
                                            <i class="i-Mail-with-At-Sign"></i> Sign in with Email
                                        </span>
                                    </router-link>

                                </div>
                                <div class="flex-grow-1"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-4">

                                <h1 class="mb-3 text-18">Sign Up</h1>
                                <form action="" @submit.prevent="signup()">
                                    <div class="form-group">
                                        <label for="username">Your name</label>
                                        <input id="username" class="form-control form-control-rounded" type="text" v-model="form.username">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input id="email" class="form-control form-control-rounded" type="email" v-model="form.email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" class="form-control form-control-rounded" type="password" v-model="form.password">
                                    </div>
                                    <div class="form-group">
                                        <label for="repassword">Retype password</label>
                                        <input id="repassword" class="form-control form-control-rounded" type="password" v-model="form.retype_password">
                                    </div>
                                    <button class="btn btn-primary btn-block btn-rounded mt-3">Sign Up</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Signup",
        data(){
           return {
               form: {
                   username: null,
                   email: null,
                   password: null,
                   retype_password: null
               }
           }
        },
        methods: {
            signup(){

            }
        }
    }
</script>

<style scoped>

</style>