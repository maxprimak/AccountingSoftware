<template>
    <div class="container">
        <div class="row">
            <b-button @click="toCompaniesPage" type="is-primary">CANCEL</b-button>
        </div>
        <div class="columns is-centered">
            <div class="column is-one-quarter">
                <form @submit="createBranchSubmit" method="POST">
                    <input type="hidden" name="_token" :value="csrf">
                    <h3 class="title has-text-centered">Add branches</h3>
                    <b-field label="Branch name">
                        <b-input v-model="name"></b-input>
                    </b-field>
                    <h5 class="subtitle">Optional</h5>
                    <b-field label="Branch address">
                        <b-input v-model="address"></b-input>
                    </b-field>
                    <b-field label="Branch phone">
                        <b-input v-model="phone"></b-input>
                    </b-field>
                    <nav class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <b-field label="Color">
                                    <swatches v-model="color" :colors="colors" row-length="6" shapes="circles" show-border popover-to="left"></swatches>                    
                                </b-field>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <b-field label="Submit">
                                    <b-button native-type="submit" type="is-primary">ADD</b-button>
                                </b-field>
                            </div>
                        </div> 
                    </nav>
                </form>
            </div>
        </div>
    </div> 
</template>

<script>

import Swatches from 'vue-swatches'
import "vue-swatches/dist/vue-swatches.min.css"

import { Toast } from 'buefy/dist/components/toast';

export default {
  components: {
    Swatches
  },
  data () {
    return {
        name: '',
        address: '',
        phone:'',
        color: this.$color,
        colors: this.$colors,
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  methods: {
      toCompaniesPage: function(){
          window.location.href = "/companies";
      },
      createBranchSubmit: function(e){
            e.preventDefault();
            axios.post('/branches', {
              name: this.name,
              address: this.address,
              phone: this.phone,
              color: this.color
            }).then(response => {
                if(!response.data.hasOwnProperty("error")){
                    this.clearForm()
                }
                Toast.open({
                  message: response.data.message + ' <a href="/companies">Go Back</a>',
                  duration: 5000
                });
            }).catch(function (error) {
                    Toast.open('Error happened! Please contact the support team')
            })
      },
      clearForm: function(){
          this.name = '';
          this.address = '';
          this.phone = '';
          this.color = '#F64272';
      }
  }
}
</script>