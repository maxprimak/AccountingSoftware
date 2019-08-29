<template>
    <section>

        <!-- <b-field grouped group-multiline>
            <div class="control">
                <b-switch v-model="showDetailIcon">Show detail icon</b-switch>
            </div>
        </b-field> -->
        <div class="column">
            <b-button @click="toCreateEmployee" type="is-primary" class="is-pulled-right">NEW EMPLOYEE</b-button>
        </div>

        <b-table
            :data="data"
            ref="table"
            paginated
            per-page="5"
            detailed
            detail-key="id"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page">

            <template slot-scope="props">
                
                <b-table-column field="id" label="ID" width="40" numeric>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="username" label="Username" sortable>
                    {{ props.row.username }}
                </b-table-column>

                <b-table-column field="role" label="Role" sortable>
                    {{ props.row.role_id }}
                </b-table-column>

                <b-table-column field="full_name" label="Full name" sortable>
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column field="phone" label="Phone" sortable>
                    {{ props.row.phone }}
                </b-table-column>

                <b-table-column field="email" label="Email" sortable>
                    {{ props.row.email }}
                </b-table-column>
            </template>

            <template slot="detail" slot-scope="props">
                <section>
                    <b-field grouped>
                        <b-field position="is-lefted">
                            <h3 class="title">Employee</h3>
                        </b-field>
                        <p class="control">
                            <b-button  @click="deleteEnployee(props.row.id, props.row.username, props)" type="is-danger">Delete</b-button>
                        </p>
                    </b-field>
                    <!-- <form @submit="employeeSubmit" method="post">
                        <input type="hidden" name="_token" :value="csrf"> -->
                        <b-field horizontal>
                            <b-field label="Full name">
                                <b-input v-model="props.row.name" name="full_name" expanded></b-input>
                            </b-field>
                            
                            <b-field label="Active/not active">
                                <b-select name="active">
                                    <option checked value="1">Active</option>
                                    <option value="2">No active</option>
                                </b-select>
                            </b-field>
                        </b-field>

                        <b-field horizontal >
                            <b-field label="Password">
                                <b-input  type="password" name="password" password-reveal expanded></b-input>
                            </b-field>

                            <b-field label="Confirm password">
                                <b-input  type="password" name="re_password" password-reveal expanded></b-input>
                            </b-field>
                        </b-field>
                        
                        <b-field horizontal>
                            <b-field label="Phone">
                                <b-input v-model="props.row.phone" name="phone" expanded></b-input>
                            </b-field>

                            <b-field label="Branch">
                                <b-select v-model="props.row.branch_id" name="branch_id">
                                    <option v-for="branch in branchs" :value="branch.id" :key="branch.name">{{ branch.name }}</option>
                                </b-select>
                            </b-field>
          
                        </b-field>

                        <b-field horizontal>
                            <b-field label="Email">
                                <b-input name="email" v-model="props.row.email" expanded></b-input>
                            </b-field>
                            
                            <b-field label="Role">
                                <b-select v-model="props.row.role_id" name="role_id">
                                    <option v-for="role in roles" :value="role.id" :key="role.name">{{ role.name }}</option>
                                </b-select>
                            </b-field>
                        </b-field>

                        <b-field horizontal>
                            <b-field label="Address">
                                <b-input name="address" v-model="props.row.address" expanded></b-input>
                            </b-field>
                        </b-field>

                        <b-input v-model="props.row.login_id" expanded></b-input>
                        <b-input v-model="props.row.person_id" expanded></b-input>

                        <b-field horizontal><!-- Label left empty for spacing -->
                            <p class="control">
                                <b-button @click="updateEmployee(props.row.id , props.row)" native-type="button" type="is-primary">Save</b-button>
                            </p>
                        </b-field>
                    <!-- </form> -->
                </section>
            </template>
        </b-table>
    
    </section>
</template>

<script>

import { Toast } from 'buefy/dist/components/toast';
import { Dialog } from 'buefy/dist/components/dialog';

    export default {
        props:['employees', 'roles', 'branchs'],
  
        data() {
            return {
                data: this.employees,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods: {
            toggle(row) {
                this.$refs.table.toggleDetails(row)
            },

            updateEmployee(employee_id, row){
                axios.post('employees/'+employee_id, {
                    full_name: row.name,
                    username: row.username,
                    password: this.password,
                    re_password: row.re_password,
                    email: row.email,
                    phone: row.phone,
                    role_id: row.role_id,
                    branch_id: row.branch_id,
                    address: row.address,
                    login_id: row.login_id,
                    person_id: row.person_id
                    
                }).then(response => {
                    Toast.open(response.data.message);
                }).catch(function (error) {
                    Toast.open('Error happened! Please contact the support team')
                });
            },

            deleteEnployee(employee_id , employee_name, props){
                Dialog.confirm({
                    title: 'Deleting employee',
                    message: 'Are you sure you want to <b>delete</b> this employee? This action cannot be undone.',
                    confirmText: 'Delete employee "'+employee_name+'"',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => axios.delete('employees/'+employee_id)
                                    .then(response => {
                                        this.data.splice(props.index, 1)
                                        Toast.open(response.data.message);
                                    }).catch(function (error) {
                                        Toast.open('Error happened! Please contact the support team')
                                    })
                })
            },

            toCreateEmployee: function() {
                window.location.href = "/employees/create"
            }
        }
    }
</script>