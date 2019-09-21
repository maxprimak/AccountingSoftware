<template>
  <section>
    <div class="columns">
      <div class="columns">
        <div class="column">
          <h3 class="title">Customers</h3>
        </div>
        <div class="column">
          <b-input v-model="search" placeholder="Search..." type="search" icon="magnify"></b-input>
        </div>
        <div class="column">
          <b-button class="is-pulled-right" @click="toCreateCustomer" type="is-primary">New Customer</b-button>
        </div>
      </div>
    </div>


    <b-table
      :data="data"
      ref="table"
      paginated
      per-page="10"
      detailed
      detail-key="id"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
    >
      <template slot-scope="props">

        <b-table-column field="id" label="ID" width="40" numeric>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.id }}</a>
        </b-table-column>

        <b-table-column field="name" label="Full name" sortable>{{ props.row.name }}</b-table-column>

        <b-table-column field="phone" label="Phone" sortable>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.phone }}</a>
        </b-table-column>

        <b-table-column field="address" label="Address" sortable>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.address }}</a>
        </b-table-column>

        <b-table-column field="email" label="Email" sortable>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.email }}</a>
        </b-table-column>

        <b-table-column field="created_at" label="Date of registration" sortable>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.created_at }}</a>
        </b-table-column>

        <b-table-column field="stars_number" label="Star" sortable>
          <star-rating @rating-selected ="setRating($event,props.row.id)" :border-width="4" :star-size="20" border-color="#d8d8d8" :rounded-corners="true" v-model="props.row.stars_number"></star-rating>
        </b-table-column>


      </template>

      <template slot="detail" slot-scope="props">
        <section>
          <div class="columns">
            <div class="column">
              <h4 class="title">Edit customer info</h4>
            </div>
            <div class="column">
              <b-button
                class="is-pulled-right"
                @click="deleteCustomer(props.row.id, props.row.username, props)"
                type="is-danger"
              >Delete</b-button>
            </div>
          </div>

          <div class="columns is-centered">
            <div class="column is-two-thirds">
              <div class="columns">
                <div class="column">
                  <b-field label="Full name">
                    <b-input v-model="props.row.name" name="name" expanded></b-input>
                  </b-field>
                </div>
                <div class="column">
                  <b-field label="Phone">
                    <b-input v-model="props.row.phone" name="phone" expanded></b-input>
                  </b-field>
                </div>
              </div>

              <div class="columns">
                <div class="column">
                  <b-field label="Address">
                    <b-input name="address" v-model="props.row.address" expanded></b-input>
                  </b-field>
                </div>
                <div class="column">
                  <b-field label="Email">
                    <b-input name="email" v-model="props.row.email" expanded></b-input>
                  </b-field>
                </div>
              </div>

              <div class="columns">
                <div class="column">
                  <div class="control">
                    <b-field label="Customer type">
                    <div class="select">
                      <b-select placeholder="Select" name="type_id" v-model="props.row.type_id">
                        <option
                          v-for="type in customer_types"
                          :value="type.id"
                          :key="type.name"
                        >{{ type.name }}</option>
                      </b-select>
                    </div>
                  </b-field>
              </div>
            </div>
                <div class="column">
                  <div class="control">
                    <b-field label="Belongs to following Branches:">
                      <div class="select">
                        <b-select
                          multiple
                          native-size="2"
                          v-model="props.row.branch_id"
                          name="branch_id"
                          placeholder="Select a branch"
                        >
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
              </div>
            </div>
          </div>
          <div class="columns is-mobile">
            <div class="column">
              <b-button
                class="is-pulled-right"
                @click="updateCustomer(props.row.id, props.row)"
                native-type="button"
                type="is-primary"
              >Save</b-button>
            </div>
          </div>
        </section>
      </template>
    </b-table>
  </section>
</template>

<script>
import { Toast } from "buefy/dist/components/toast";
import { Dialog } from "buefy/dist/components/dialog";

    export default {
      props: ["customers","customer_types","branches"],

      mounted(){
      },
      data() {
        return {
          data: this.customers,
          checkboxPosition: 'right',
          csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        };
      },
      methods: {
        toggle(row) {
          this.$refs.table.toggleDetails(row);
        },

        updateCustomer(customer_id, row) {
          axios
            .post("customers/" + customer_id, {
              name: row.name,
              email: row.email,
              address: row.address,
              phone: row.phone,
              type_id: row.type_id,
              branch_id: row.branch_id,
            })
            .then(response => {
              Toast.open(response.data.message);
            })
            .catch(function(error) {
              Toast.open("Error happened! Please contact the support team");
            });
        },

        deleteCustomer(customer_id, customer_name, props) {
          Dialog.confirm({
            title: "Deleting customer",
            message:
              "Are you sure you want to <b>delete</b> this customer? This action cannot be undone.",
            confirmText: 'Delete customer "' + customer_name + '"',
            type: "is-danger",
            hasIcon: true,
            onConfirm: () =>
              axios
                .delete("customers/" + customer_id)
                .then(response => {
                  this.data.splice(props.index, 1);
                  Toast.open(response.data.message);
                })
                .catch(function(error) {
                  Toast.open("Error happened! Please contact the support team");
                })
          });
        },

        toCreateCustomer: function() {
          window.location.href = "/customers/create";
        },

        setRating: function(stars_number,customer_id){
          console.log(stars_number);
          axios
            .post("customers/set_stars_number/" + customer_id, {
              stars_number: stars_number,
            })
            .then(response => {
              Toast.open(response.data.message);
            })
            .catch(function(error) {
              Toast.open("Error happened! Please contact the support team");
            });
        }
      },

      computed: {
        filteredCustomers: function() {
          return this.data.filter(customers => {
            return (
              customers.mail.match(this.search) ||
              customers.name.match(this.search) ||
              customers.phone.match(this.search) ||
              customers.email.match(this.search)
            );
          });
        }
      }
    };
</script>

<!-- // <script>
//     export default {
//       props:['array_test'],
//
//       // mounted(){
//       //   console.log(this.array_test);
//       // },
//
//       data(){
//           return{
//             test: this.array_test,
//             YesOrNo: true,
//           }
//         },
//         methods: {
//           testYesOrNo: function() {
//             this.YesOrNo = false;
//         }
//       }
//     }
// </script> -->
