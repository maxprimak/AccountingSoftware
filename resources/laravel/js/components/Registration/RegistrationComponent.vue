<template>
    <b-steps>
        <b-step-item label="Person">
            <div class="columns is-centered">
                <div class="column is-one-quarter">
                    <h3 class="title has-text-centered">Add your personal info</h3>
                    <b-field label="Your name">
                        <b-input name="new_full_name" v-model="new_full_name"></b-input>
                    </b-field>
                    <b-field label="Your phone">
                        <b-input name="new_phone" v-model="new_phone"></b-input>
                    </b-field>
                    <b-field label="Your address">
                        <b-input name="new_address" v-model="new_address"></b-input>
                    </b-field>
                </div>
            </div>
        </b-step-item>
        <b-step-item label="Company">
            <div class="columns is-centered">
                <div class="column is-one-quarter">
                    <h3 class="title has-text-centered">Add your company info</h3>
                    <b-field label="Company name">
                        <b-input></b-input>
                    </b-field>
                    <b-field label="Company address">
                        <b-input></b-input>
                    </b-field>
                    <b-field label="Company phone">
                        <b-input></b-input>
                    </b-field>
                    <div class="level">
                        <div class="level-right">
                            <b-field label="Company currency">
                                <b-select>
                                    <option selected>USD</option>
                                </b-select>
                            </b-field>
                        </div>
                        <div class="level-left">
                            <b-field label="Submit">
                            <b-button @click="submitRegistration" class="is-primary">START</b-button>
                            </b-field>
                        </div>
                    </div>
                </div>
            </div>
        </b-step-item>
    </b-steps>
</template>

<script>

    import { Toast } from 'buefy/dist/components/toast';

    export default {
        data() {
            return {
                new_full_name: '',
                new_address: '',
                new_phone: ''
            }
        },
        methods: {
            submitRegistration: function(){
                axios.post("/registration", {
                    new_full_name: this.new_full_name,
                    new_address: this.new_address,
                    new_phone: this.new_phone
                }).then(function (response) {
                    Toast.open(response.data)
                }).catch(function (error) {
                    console.log(error.response.data)
                });
            }
        }
    }
</script>