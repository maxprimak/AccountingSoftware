<template>
<section>
<div class="columns">
  <div class="column">
    <h3 class="title">My Company</h3>
    <h3 class="subtitle">Branches</h3>
  </div>
  <div class="column">
    <form @submit="companySubmit" method="post">
        <input type="hidden" name="_token" :value="csrf">
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <b-field label="Company name">
                        <b-input @change.native="submitChangeVisibility" v-model="name" name="name"></b-input>
                    </b-field>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <b-field label="Company address">
                        <b-input @change.native="submitChangeVisibility" v-model="address" name="address"></b-input>
                    </b-field>
                </div>
            </div>
        </nav>
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <b-field label="Company phone">
                        <b-input @change.native="submitChangeVisibility" v-model="phone" name="phone"></b-input>
                    </b-field>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <b-field label="Currency">
                        <b-select @change.native="submitChangeVisibility" v-model="currency_id" name="currency_id" placeholder="Select">
                            <option v-for="currency in currencies" :value="currency.id" :key="currency.name">
                            {{ currency.symbol }}
                            </option>
                        </b-select>
                    </b-field>
                </div>
                <div class="level-item">
                    <b-field label="Submit" :class="{ 'is-hidden' : submitNotVisible }">
                        <b-button native-type="submit" type="is-primary" class="is-pulled-right">Save</b-button>
                    </b-field>
                </div>
            </div>
        </nav>
    </form>
  </div>
  <div class="column">
    <b-button @click="toCreateBranch" type="is-primary" class="is-pulled-right">NEW BRANCH</b-button>
  </div>
</div>
</section>
</template>

<script>

    import { Toast } from 'buefy/dist/components/toast';

    export default {
        props:['company', 'currencies'], 
        data() {
            return {
                data: this.company,
                submitNotVisible: true,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name: this.company.name,
                address: this.company.address,
                phone: this.company.phone,
                currency_id: this.company.currency_id,
            }
        },
        methods: {
            submitChangeVisibility: function () {
                this.submitNotVisible = false;
            },
            companySubmit: function (e) {
                e.preventDefault();
                axios.post('/companies/'+this.company.id,{
                    name: this.name,
                    address: this.address,
                    phone: this.phone,
                    currency_id: this.currency_id
                })
                .then(function (response) {
                    Toast.open(response.data)
                }).catch(function (error) {
                    Toast.open(error.response.data)
                });
            },
            toCreateBranch: function() {
                window.location.href = "/branches/create"
            }
        }
    }
</script>