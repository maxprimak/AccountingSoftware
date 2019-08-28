<template>
    <b-table :paginated="true" :per-page="10" :data="branchesList">

            <template slot-scope="props">
                <b-table-column field="name" label="Name">
                    <b-input @change.native="showSubmitButton" name="name" v-model="props.row.name"></b-input>
                </b-table-column>
                <b-table-column field="color" label="Color">
                    <swatches @input="showSubmitButton" v-model="props.row.color" :colors="colors" name="color" row-length="6" shapes="circles" show-border popover-to="left"></swatches>
                </b-table-column>
                <b-table-column field="address" label="Address">
                    <b-input @change.native="showSubmitButton" v-model="props.row.address"></b-input>
                </b-table-column>
                <b-table-column field="phone" label="Phone">
                    <b-input @change.native="showSubmitButton" v-model="props.row.phone"></b-input>
                </b-table-column>
                <b-table-column>
                    <b-button :class="{'is-hidden' : changesNotMade}" @click="updateBranch(props.row.id , props.row)" native-type="button" type="is-primary">Save</b-button>
                </b-table-column>
                <b-table-column label="">
                    <b-button @click="deleteBranch(props.row.id, props.row.name, props)" type="is-text">
                        <v-icon name="times" scale="1.5" />
                    </b-button>
                </b-table-column>
            </template>

            <template slot="empty">
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <b-icon
                                icon="emoticon-sad"
                                size="is-large">
                            </b-icon>
                        </p>
                        <p>Nothing here.</p>
                    </div>
                </section>
            </template>

    </b-table>
</template>

<script>
import Swatches from 'vue-swatches'
import "vue-swatches/dist/vue-swatches.min.css"

import { Toast } from 'buefy/dist/components/toast';
import { Dialog } from 'buefy/dist/components/dialog';

    export default {
        props: ['branches'],
        components: {
            Swatches
        },
        data() {
            return {
               branchesList: this.branches,
               colors: this.$colors,
               changesNotMade: true
            }
        },
        methods: {
            updateBranch(branch_id, row){
                axios.post('/branches/'+branch_id, {
                    name: row.name,
                    address: row.address,
                    color: row.color,
                    phone: row.phone
                }).then(response => {
                    Toast.open(response.data.message);
                }).catch(function (error) {
                    Toast.open('Error happened! Please contact the support team')
                });
            },
            deleteBranch(branch_id , branch_name, props){
                Dialog.confirm({
                    title: 'Deleting branch',
                    message: 'Are you sure you want to <b>delete</b> this branch? This action cannot be undone.',
                    confirmText: 'Delete branch "'+branch_name+'"',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => axios.delete('branches/'+branch_id)
                                    .then(response => {
                                        this.branchesList.splice(props.index, 1)
                                        Toast.open(response.data.message);
                                    }).catch(function (error) {
                                        Toast.open('Error happened! Please contact the support team')
                                    })
                })
            },
            showSubmitButton(){
                if(this.changesNotMade == true) this.changesNotMade = false
                console.log(this.changesNotMade)
            }
        },
        mounted() {
               //
        }
    }
</script>