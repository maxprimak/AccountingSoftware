<template>
    <div class="text-left">
        <div class="auth-layout-wrap" style="background-image: url(/vue-assets/img/sign_back.jpg)">
            <div class="auth-content">
                <div class="card o-hidden">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4">
                                    <img src="/assets/images/logo.png" alt="">
                                </div>
                                <h1 class="mb-3 text-18">Sign In</h1>
                                <form @submit.prevent="signin()">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input id="email" class="form-control form-control-rounded" type="email" v-model="form.email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" class="form-control form-control-rounded" type="password" v-model="form.password">
                                    </div>
                                    <button class="btn btn-rounded btn-primary btn-block mt-2">Sign In</button>
                                </form>

                                <div class="mt-3 text-center">
                                    <router-link to="/forgot">
                                        <span class="text-muted"><u>Forgot Password?</u></span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center " style="background-size: cover;background-image: url(/vue-assets/img/photo-long-3.jpg)">
                            <div class="pr-3 auth-right">
                                <div class="w-100">
                                    <router-link to="/signup">
                                        <span class="btn btn-outline-primary btn-outline-email btn-block btn-icon-text btn-rounded"><i data-v-3f144ca0="" class="i-Mail-with-At-Sign"></i> Sign in with Email
                                        </span>
                                    </router-link>
                                </div>
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
        name: "Sign",
        data(){
            return {
                form: {
                    email: null,
                    password: null
                }

            }
        },
        methods:{
            signin(){
                alert()
            }
        }
    }
</script>

<style scoped>

</style>