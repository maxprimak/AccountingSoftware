<template>
  <section>
    <div class="columns">
      <div class="column">
        <h3 class="title">Employees</h3>
      </div>
      <div class="column">
        <b-input v-model="search" placeholder="Search..." type="search" icon="magnify"></b-input>
      </div>
      <div class="column">
        <b-button class="is-pulled-right" @click="toCreateEmployee" type="is-primary">NEW EMPLOYEE</b-button>
      </div>
    </div>

    <b-table
      :data="filteredEmployees"
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

        <b-table-column field="photo" label="Photo" sortable>
          <a @click="toggle(props.row)">
            <figure class="image is-32x32">
              <img
                class="is-rounded"
                :src="'/avatars/' + props.row.user_id + '_avatar.png'"
                @error="imageLoadError"
              />
            </figure>
          </a>
        </b-table-column>

        <b-table-column field="username" label="Username" sortable>{{ props.row.username }}</b-table-column>

        <b-table-column field="active" label="Active" sortable>
          <template v-if="props.row.is_active == 0">
            <a @click="toggle(props.row)" class="has-text-danger">Not active</a>
          </template>
          <template v-else>
            <a @click="toggle(props.row)" class="has-text-success">Active</a>
          </template>
        </b-table-column>

        <b-table-column field="pasword" label="Password" sortable>
          <a @click="toggle(props.row)" class="has-text-success">Set</a>
        </b-table-column>

        <b-table-column class="has-text-link" field="role" label="Role" sortable>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.role_name }}</a>
        </b-table-column>

        <b-table-column field="name" label="Full name" sortable>{{ props.row.name }}</b-table-column>

        <b-table-column field="phone" label="Phone" sortable>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.phone }}</a>
        </b-table-column>

        <b-table-column field="email" label="Email" sortable>
          <a @click="toggle(props.row)" class="has-text-link">{{ props.row.email }}</a>
        </b-table-column>
      </template>

      <template slot="detail" slot-scope="props">
        <section>
          <div class="columns">
            <div class="column">
              <h4 class="title">Edit employee info</h4>
            </div>
            <div class="column">
              <b-button
                v-if="auth_id != props.row.login_id"
                class="is-pulled-right"
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
                    <b-input v-model="props.row.name" name="name" expanded></b-input>
                  </b-field>
                </div>
                <div class="column">
                  <div class="control">
                    <b-field label="Active/not active">
                      <div class="select">
                        <b-select v-model="props.row.is_active" name="active" placeholder="Select">
                          <option
                            v-for="active in selects"
                            :value="active.value"
                            :key="active.key"
                          >{{ active.key }}</option>
                        </b-select>
                      </div>
                    </b-field>
                  </div>
                </div>
              </div>
              <div class="columns">
                <div class="column">
                  <b-field label="Password">
                    <b-input placeholder="**********" v-model="props.row.password"></b-input>
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
                  <div class="control">
                    <b-field label="Role">
                      <div class="select">
                        <b-select
                          v-model="props.row.role_id"
                          name="role_id"
                          placeholder="Select a role"
                        >
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
                    <b-field label="Works in Branches">
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

              <div class="columns">
                <div class="column">
                  <b-field label="Photo">
                    <div class="file">
                      <label class="file-label">
                        <input
                          class="file-input"
                          v-on:change="onImageChange"
                          type="file"
                          name="resume"
                        />
                        <span class="file-cta">
                          <span v-if="image" class="file-label">Loaded</span>
                          <span v-else class="file-label">Load</span>
                        </span>
                      </label>
                    </div>
                  </b-field>
                </div>
              </div>
            </div>
          </div>
          <div class="columns is-mobile">
            <div class="column">
              <b-button
                class="is-pulled-right"
                @click="updateEmployee(props.row.id, props.row)"
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
  props: ["employees", "roles", "branches", "auth_id"],

  data() {
    return {
      data: this.employees,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      search: "",
      password: "",
      image: "",
      selects: [{ value: 0, key: "Not active" }, { value: 1, key: "Active" }]
    };
  },

  methods: {
    toggle(row) {
      this.$refs.table.toggleDetails(row);
    },

    imageLoadError(event) {
      event.target.src = "https://bulma.io/images/placeholders/32x32.png";
    },

    onImageChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = e => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    updateEmployee(employee_id, row) {
      axios
        .post("employees/" + employee_id, {
          name: row.name,
          is_active: row.is_active,
          username: row.username,
          password: row.password,
          email: row.email,
          phone: row.phone,
          role_id: row.role_id,
          branch_id: row.branch_id,
          address: row.address,
          image: this.image
        })
        .then(response => {
          this.image = "";
          Toast.open(response.data.message);
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
              this.filteredEmployees.splice(props.index, 1);
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
  },

  computed: {
    filteredEmployees: function() {
      return this.data.filter(employee => {
        return (
          employee.username.match(this.search) ||
          employee.name.match(this.search) ||
          employee.phone.match(this.search) ||
          employee.email.match(this.search)
        );
      });
    }
  }
};
</script>
