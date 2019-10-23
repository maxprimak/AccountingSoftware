<template>
  <div class="container">
    <div class="row">
      <b-button @click="toEmployeesPage" type="is-primary">CANCEL</b-button>
    </div>
    <div class="columns is-centered">
      <div class="column is-two-thirds">
        <form @submit="createEmployeeSubmit" method="POST">
          <input type="hidden" name="_token" :value="csrf" />
          <h3 class="title has-text-centered">New employee</h3>

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
              <b-field label="Username">
                <b-input v-model="username"></b-input>
              </b-field>
            </div>
            <div class="column">
              <b-field label="Phone">
                <b-input v-model="phone"></b-input>
              </b-field>
            </div>
          </div>

          <div class="columns">
            <div class="column">
              <b-field label="Password">
                <b-input type="password" v-model="password" password-reveal></b-input>
              </b-field>
            </div>
            <div class="column">
              <b-field label="Confirm password">
                <b-input type="password" v-model="re_password" password-reveal></b-input>
              </b-field>
            </div>
          </div>

          <div class="columns">
            <div class="column">
              <b-field label="Address">
                <b-input v-model="address"></b-input>
              </b-field>
            </div>

            <div class="column">
              <div class="control">
                <b-field label="Role">
                  <div class="select">
                    <b-select placeholder="Select" name="role_id" v-model="role_id">
                      <option
                        v-for="role in roles"
                        :value="role.id"
                        :key="role.name"
                      >{{ role.name }}</option>
                    </b-select>
                  </div>
                </b-field>
              </div>
            </div>
          </div>

          <div class="columns">
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
  props: ["roles", "branches"],

  data() {
    return {
      name: "",
      email: "",
      username: "",
      password: "",
      re_password: "",
      address: "",
      phone: "",
      branch_id: [],
      role_id: null,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    toEmployeesPage: function() {
      window.location.href = "/employees";
    },
    createEmployeeSubmit: function(e) {
      e.preventDefault();
      axios
        .post("/employees", {
          name: this.name,
          email: this.email,
          username: this.username,
          password: this.password,
          re_password: this.re_password,
          address: this.address,
          phone: this.phone,
          role_id: this.role_id,
          branch_id: this.branch_id
        })
        .then(response => {
          console.log(response)
          if (!response.data.hasOwnProperty("error")) {
            this.clearForm();
            this.branch_id = [];
          }
          Toast.open({
            message:
              response.data.message + ' <a href="/employees">Go Back</a>',
            duration: 5000
          });
        })
        .catch(function(error) {
          Toast.open("Error happened! Please contact the support team");
        });
    },
    clearForm: function() {
      (this.name = ""),
        (this.email = ""),
        (this.username = ""),
        (this.password = ""),
        (this.re_password = ""),
        (this.address = ""),
        (this.phone = ""),
        (this.branch_id = ""),
        (this.role_id = "");
    }
  }
};
</script>