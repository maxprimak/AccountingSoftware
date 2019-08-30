<template>
  <section>
    <div class="columns">
        <div class="column is-4">
            <h3 class="title">Employees</h3>
        </div>
        <div class="column is-6">
            <b-field grouped>
            <b-input placeholder="Search..." type="search" icon="magnify">
            </b-input>
            <p class="control">
                <button class="button is-info">Search</button>
            </p>
        </b-field>
        </div>
      <div class="column">
        <b-button @click="toCreateEmployee" type="is-primary">NEW EMPLOYEE</b-button>
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
        <b-table-column field="id" label="ID" width="40" numeric>{{ props.row.id }}</b-table-column>

        <b-table-column field="username" label="Username" sortable>{{ props.row.username }}</b-table-column>

        <b-table-column field="role" label="Role" sortable>{{ props.row.role_name }}</b-table-column>

        <b-table-column field="full_name" label="Full name" sortable>{{ props.row.name }}</b-table-column>

        <b-table-column field="phone" label="Phone" sortable>{{ props.row.phone }}</b-table-column>

        <b-table-column field="email" label="Email" sortable>{{ props.row.email }}</b-table-column>
      </template>

      <template slot="detail" slot-scope="props">
        <section>
          <div class="columns">
            <div class="column is-11">
              <h4 class="title">Edit employee info</h4>
            </div>
            <div class="column">
              <b-button
                @click="deleteEnployee(props.row.id, props.row.username, props)"
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
                <div class="column">
                  <div class="control">
                    <b-field label="Active/not active">
                      <div class="select">
                        <b-select name="active" placeholder="Select">
                          <option checked value="1">Active</option>
                          <option value="2">No active</option>
                        </b-select>
                      </div>
                    </b-field>
                  </div>
                </div>
              </div>
              <div class="columns">
                <div class="column">
                  <b-field label="Password">
                    <b-input
                      v-model="password"
                      type="password"
                      name="password"
                      password-reveal
                      expanded
                    ></b-input>
                  </b-field>
                </div>
                <div class="column">
                  <b-field label="Confirm password">
                    <b-input
                      v-model="re_password"
                      type="password"
                      name="re_password"
                      password-reveal
                      expanded
                    ></b-input>
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
                  <div class="control">
                    <b-field label="Branch">
                      <div class="select">
                        <b-select v-model="props.row.branch_id" name="branch_id" placeholder="Select a branch">
                          <option
                            v-for="branch in branchs"
                            :value="branch.id"
                            :key="branch.name"
                          >{{ branch.name }}</option>
                        </b-select>
                      </div>
                    </b-field>
                  </div>
                </div>
              </div>

              <div class="columns">
                <div class="column">
                  <b-field label="Email">
                    <b-input name="email" v-model="props.row.email" expanded></b-input>
                  </b-field>
                </div>
                <div class="column">
                  <div class="control">
                    <b-field label="Role">
                      <div class="select">
                        <b-select v-model="props.row.role_id" name="role_id" placeholder="Select a role">
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
                <div class="column is-half">
                  <b-field label="Address">
                    <b-input name="address" v-model="props.row.address" expanded></b-input>
                  </b-field>
                </div>
              </div>

              <div class="columns">
                <div class="column">
                  <p class="control">
                    <b-button
                      @click="updateEmployee(props.row.id, props.row)"
                      native-type="button"
                      type="is-primary"
                    >Save</b-button>
                  </p>
                </div>
              </div>
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
  props: ["employees", "roles", "branchs"],

  data() {
    return {
      data: this.employees,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      password: "",
      re_password: ""
    };
  },
  methods: {
    toggle(row) {
      this.$refs.table.toggleDetails(row);
    },

    updateEmployee(employee_id, row) {
      axios
        .post("employees/" + employee_id, {
          full_name: row.name,
          username: row.username,
          password: this.password,
          re_password: this.re_password,
          email: row.email,
          phone: row.phone,
          role_id: row.role_id,
          branch_id: row.branch_id,
          address: row.address,
          login_id: row.login_id,
          person_id: row.person_id
        })
        .then(response => {
          Toast.open(response.data.message);
          this.password = "";
          this.re_password = "";
        })
        .catch(function(error) {
          Toast.open("Error happened! Please contact the support team");
        });
    },

    deleteEnployee(employee_id, employee_name, props) {
      Dialog.confirm({
        title: "Deleting employee",
        message:
          "Are you sure you want to <b>delete</b> this employee? This action cannot be undone.",
        confirmText: 'Delete employee "' + employee_name + '"',
        type: "is-danger",
        hasIcon: true,
        onConfirm: () =>
          axios
            .delete("employees/" + employee_id)
            .then(response => {
              this.data.splice(props.index, 1);
              Toast.open(response.data.message);
            })
            .catch(function(error) {
              Toast.open("Error happened! Please contact the support team");
            })
      });
    },

    toCreateEmployee: function() {
      window.location.href = "/employees/create";
    }
  }
};
</script>