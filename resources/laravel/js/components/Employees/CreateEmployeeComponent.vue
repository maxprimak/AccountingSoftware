<template>
    <div class="container">
        <div class="row">
            <b-button @click="toEmployeesPage" type="is-primary">CANCEL</b-button>
        </div>
        <div class="columns is-centered">
            <div class="column is-one-quarter">
                <form @submit="createEmployeeSubmit" method="POST">
                    <input type="hidden" name="_token" :value="csrf">
                    <h3 class="title has-text-centered">New employee</h3>
                    <b-field grouped position="is-centered">
                        <b-field label="Full name">
                            <b-input v-model="name"></b-input>
                        </b-field>
                        <b-field label="Email">
                            <b-input v-model="email"></b-input>
                        </b-field>
                    </b-field>

                    <b-field grouped position="is-centered">
                        <b-field label="Username">
                            <b-input v-model="username"></b-input>
                        </b-field>
                        <b-field label="Phone">
                            <b-input v-model="phone"></b-input>
                        </b-field>
                    </b-field>

                    <b-field grouped position="is-centered">
                        <b-field label="Password">
                            <b-input v-model="password" password-reveal></b-input>
                        </b-field>
                        <b-field label="Confirm password">
                            <b-input v-model="re_password" password-reveal></b-input>
                        </b-field>
                    </b-field>

                    <b-field grouped position="is-centered">
                        
                        <b-field label="Branch">
                            <b-select name="branch_id" v-model="branch_id">
                                <option v-for="branch in branchs" :value="branch.id" :key="branch.name">{{ branch.name }}</option>
                            </b-select>
                        </b-field>
                        <b-field label="Role">
                            <b-select name="role_id" v-model="role_id">
                                <option v-for="role in roles" :value="role.id" :key="role.name">{{ role.name }}</option>
                            </b-select>
                        </b-field>
                    </b-field>

                    <b-field grouped position="is-centered">
                        <b-field label="Address">
                            <b-input v-model="address"></b-input>
                        </b-field>
                    </b-field>
                    
                    <b-field grouped position="is-centered">
                        <b-button native-type="submit" type="is-primary">ADD</b-button>
                    </b-field>
                </form>
            </div>
        </div>
    </div> 
</template>

<script>

import { Toast } from 'buefy/dist/components/toast';

export default {
  props:['roles', 'branchs'],

  data () {
    return {
        name: '',
        email: '',
        username: '',
        password: '',
        re_password: '',
        address: '',
        phone:'',
        branch_id: '',
        role_id: '',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  methods: {
      toEmployeesPage: function(){
          window.location.href = "/employees";
      },
      createEmployeeSubmit: function(e){
            e.preventDefault();
            axios.post('/employees', {
              new_full_name: this.name,
              new_email: this.email,
              new_username: this.username,
              new_password: this.password,
              re_password: this.re_password,
              new_address: this.address,
              new_phone: this.phone,
              branch_id: this.branch_id,
              role_id: this.role_id
            }).then(response => {
                if(!response.data.hasOwnProperty("error")){
                    this.clearForm()
                }
                Toast.open({
                  message: response.data.message + ' <a href="/employees">Go Back</a>',
                  duration: 5000
                });
            }).catch(function (error) {
                    Toast.open('Error happened! Please contact the support team')
            })
      },
      clearForm: function(){
            this.name = '',
            this.email = '',
            this.username = '',
            this.password = '',
            this.re_password = '',
            this.address = '',
            this.phone ='',
            this.branch_id = '',
            this.role_id = ''
      }
  }
}
</script>