<template>
  <section>
    <div class="columns">
      <div class="column is-4">
        <h3 class="title">Customers</h3>
      </div>
      <div class="column is-6">
        <b-field grouped>
          <b-input placeholder="Search..." type="search" icon="magnify"></b-input>
          <p class="control">
            <button class="button is-info">Search</button>
          </p>
        </b-field>
      </div>
      <div class="column">
        <b-button @click="toCreateCustomer" type="is-primary">New Customer</b-button>
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
        <!-- <b-table-column field = "grouped group-multiline">
            <button class="button field is-danger" @click="props.checkedRows = []"
                :disabled="!props.checkedRows.length">
                <b-icon icon="close"></b-icon>
                <span>Clear checked</span>
            </button>
            <b-select v-model="checkboxPosition">
                <option value="left">Checkbox at left</option>
                <option value="right">Checkbox at right</option>
            </b-select>
        </b-table-column> -->
        <b-table-column field="id" label="ID" width="40" numeric>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.id }}</a>
        </b-table-column>

        <b-table-column field="full_name" label="Full name" sortable>{{ props.row.name }}</b-table-column>

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
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.stars_number }}</a>
        </b-table-column>

        <b-tab-item label="Checked rows">
                <pre>{{ checkedRows }}</pre>
        </b-tab-item>


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
                    <b-input v-model="props.row.name" name="full_name" expanded></b-input>
                  </b-field>
                </div>
              </div>

              <div class="columns">
                <div class="column">
                  <b-field label="Phone">
                    <b-input v-model="props.row.phone" name="phone" expanded></b-input>
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
                  <b-field label="Address">
                    <b-input name="address" v-model="props.row.address" expanded></b-input>
                  </b-field>
                </div>
                <div class="column">
                  <div class="control">
                    <b-field label="Belongs to folowing Branches:">
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
                          >{{ branch.id }}</option>
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

    // export default {
    //     data() {
    //         return {
    //           id: 1,
    //           first_name: "Maxim",
    //           last_name: "Primak",
    //         }
    //     },
    //     methods: {
    //         toggle(row) {
    //             this.$refs.table.toggleDetails(row)
    //         }
    //     }
    // }

    export default {
      props: ["customers"],

      mounted(){
        console.log(this.customers)
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
              full_name: row.name,
              email: row.email,
              phone: row.phone,
              branch_id: row.branch_id,
              address: row.address,
              person_id: row.person_id,
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
