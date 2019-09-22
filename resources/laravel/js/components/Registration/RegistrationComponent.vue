<template>
    <b-steps
    :animated="true"
    :has-navigation="false">
        <b-step-item :clickable="true" label="Person">
            <div class="columns is-centered">
                <div class="column is-one-quarter">
                    <h3 class="title has-text-centered">Add your personal info</h3>
                    <b-field label="Your name">
                        <b-input name="name" v-model="name"></b-input>
                    </b-field>
                    <b-field label="Your phone">
                        <b-input name="phone" v-model="phone"></b-input>
                    </b-field>
                    <b-field label="Your address">
                        <b-input name="address" v-model="address"></b-input>
                    </b-field>
                </div>
            </div>
        </b-step-item>
        <b-step-item :clickable="true" label="Company">
            <div class="columns is-centered">
                <div class="column is-one-quarter">
                    <h3 class="title has-text-centered">Add your company info</h3>
                    <b-field label="Company name">
                        <b-input name="company_name" v-model="company_name"></b-input>
                    </b-field>
                    <b-field label="Company address">
                        <b-input name="company_address" v-model="company_address"></b-input>
                    </b-field>
                    <b-field label="Company phone">
                        <b-input name="company_phone" v-model="company_phone"></b-input>
                    </b-field>
                    <div class="level">
                        <div class="level-right">
                            <b-field label="Company currency">
                                <b-select name="currency_id" placeholder="Select" v-model="currency_id">
                                    <option v-for="currency in currencies" :value="currency.id" :key="currency.name">
                                        {{ currency.symbol }}
                                    </option>
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
        props: ['currencies'],
        data() {
            return {
                name: '',
                address: '',
                phone: '',
                company_name: '', 
                company_address: '',
                company_phone: '',
                currency_id: null
            }
        },
        methods: {
            submitRegistration: function(){
                axios.post("/registration", {
                    name: this.name,
                    address: this.address,
                    phone: this.phone,
                    company_name: this.company_name,
                    company_address: this.company_address,
                    company_phone: this.company_phone,
                    currency_id: this.currency_id
                }).then(function (response) {
                    window.location.href = "/companies"
                }).catch(function (error) {
                    if(error.response.status == 422)
                    Toast.open(Object.values(error.response.data.errors)[0][0])
                    else
                    Toast.open('Error happened! Please contact the support team')
                });
            }
        }
    }
</script>