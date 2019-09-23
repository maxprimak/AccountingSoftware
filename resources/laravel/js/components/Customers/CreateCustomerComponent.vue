<template>
  <div class="container">
    <div class="row">
      <b-button @click="toCustomersPage" type="is-primary">CANCEL</b-button>
    </div>
    <div class="columns is-centered">
      <div class="column is-two-thirds">
        <form @submit="createCustomersubmit" method="POST">
          <input type="hidden" name="_token" :value="csrf" />
          <h3 class="title has-text-centered">New customer</h3>

          <div class="columns">
            <div class="column">
              <b-field label="Full name">
                <b-input v-model="name"></b-input>
              </b-field>
            </div>
            <div class="column">
              <b-field label="Email">
                <b-input v-model="email"></b-input>
              </b-field>
            </div>
          </div>

          <div class="columns">
            <div class="column">
              <b-field label="Phone">
                <b-input v-model="phone"></b-input>
              </b-field>
            </div>
            <div class="column">
              <b-field label="Address">
                <b-input v-model="address"></b-input>
              </b-field>
            </div>
          </div>

          <div class="columns">
            <div class="column">
              <div class="control">
                <b-field label="Customer type">
                  <div class="select">
                    <b-select placeholder="Select" name="customer_type_id" v-model="customer_type_id">
                      <option
                        v-for="customer_type in customer_types"
                        :value="customer_type.id"
                        :key="customer_type.name"
                      >{{ customer_type.name }}</option>
                    </b-select>
                  </div>
                </b-field>
              </div>
            </div>
            <div class="column">
              <div class="control">
                <b-field label="Works in Branches">
                  <div class="select">
                    <b-select multiple native-size="2" name="branch_id" expanded v-model="branch_id">
                      <option
                        v-for="branch in branches"
                        :value="branch.id"
                        :key="branch.name"
                      >{{ branch.name }}</option>
                    </b-select>
                  </div>
                </b-field>
              </div>
            </div>
            <div class="column">
              <b-button style="margin-top:31px" class="is-pulled-right" native-type="submit" type="is-primary">ADD</b-button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Toast } from "buefy/dist/components/toast";

export default {
  props: ["user_id", "branches", "customer_types"],

  data() {
    return {
      name: "",
      email: "",
      address: "",
      phone: "",
      customer_type_id: null,
      branch_id: [],
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    toCustomersPage: function() {
      window.location.href = "/customers";
    },
    createCustomersubmit: function(e) {
      e.preventDefault();
      axios
        .post("/customers", {
          name: this.name,
          email: this.email,
          address: this.address,
          phone: this.phone,
          customer_type_id: this.customer_type_id,
          branch_id: this.branch_id,
          user_id: this.user_id
        })
        .then(response => {
          console.log(response)
          if (!response.data.hasOwnProperty("error")) {
            this.clearForm();
          }
          Toast.open({
            message:
              response.data.message + ' <a href="/customers">Go Back</a>',
            duration: 5000
          });
        })
        .catch(function (error) {
            if(error.response.status == 422)
            Toast.open(error.response.data.errors[0][0])
            else
            Toast.open('Error happened! Please contact the support team')
        });
    },
    clearForm: function() {
      (this.name = ""),
        (this.email = ""),
        (this.address = ""),
        (this.phone = ""),
        (this.branch_id = ""),
        (this.customer_type_id = "");
    }
  }
};
</script>
