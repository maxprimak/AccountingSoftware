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
                                <h1 class="mb-3 text-18">Forgot Password</h1>
                                <form @submit.prevent="forgot">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input id="email" class="form-control form-control-rounded" type="email" v-model.trim="form.email">
                                    </div>
                                    <button class="btn btn-primary btn-block btn-rounded mt-3" @click="forgot">Reset Password</button>

                                </form>
                                <div class="mt-3 text-center">
                                    <router-link to="/signin">
                                        <span class="text-muted"><u>Sign in</u></span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center " style="background-size: cover;background-image: url(/vue-assets/img/photo-long-3.jpg)">
                            <div class="pr-3 auth-right">
                                <div class="w-100">
                                    <router-link to="/signup">
                                        <span class="btn btn-outline-primary btn-outline-email btn-block btn-icon-text btn-rounded">
                                            <i class="i-Mail-with-At-Sign"></i> Sign up with Email
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
        name: "Forget",
        data(){
            return {
                form:{
                    email: null
                }
            }
        },
        methods:{
            forgot(){
                alert(this.form.email);
            }
        }
    }
</script>

<style scoped>

</style>