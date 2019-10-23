<template>
    <div class="container">
    <div class="columns is-centered">
        <div class="column">
            <div class="row">
                <a href="#" style="margin-right: 8%"><p class="title is-4">Repair orders</p></a>
                <a href="#"><p style="color: grey;">Sales orders</p></a>
            </div>
        </div>
        <div class="column">
            <b-input placeholder="Search..."
                type="search"
                size="is-small"
                style="width: 80%"
                icon="magnify" rounded>
            </b-input>
        </div>
        <div class="column">
            <div class="level">
                <div class="level-left"></div>
                <div class="level-right">
                    <a style="margin-right: 20%"><v-icon name="cog" scale="1.4"/></a>
                    <a href="/repair-orders/create" class="btn btn-primary" style="margin-right: 22%">NEW ORDER</a>
                </div>  
            </div>
            
        </div>
    </div>
        <div class="row justify-content-center">
            <b-table
            :data="data"
            ref="table"
            paginated
            per-page="10"
            :opened-detailed="[]"
            detailed
            detail-key="id"
            @details-open="(row, index) => $toast.open(`Expanded ${row.name}`)"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            :show-detail-icon="false"
            aria-page-label="Page"
            aria-current-label="Current page"
            style="width: 100%; font-family: Nunito;">
            <template slot-scope="props">

                <b-table-column field="id" label="Order ID">
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.id }}
                        </a>
                </template>
                </b-table-column>

                <b-table-column field="name" label="Created by">
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.name }}
                        </a>
                </template>
                </b-table-column>

                <b-table-column field="status" label="Manager" >
                    <template>
                        <a @click="toggle(props.row)">
                            <span class="badge badge-success">
                            {{ props.row.status }}
                            </span>
                        </a>
                    </template>
                </b-table-column>

                <b-table-column field="age" label="Status" >
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.age }}
                        </a>
                </template>
                </b-table-column>

                <b-table-column field="price" label="Device" >
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price }}
                        </a>
                    </template>
                </b-table-column>

                 <b-table-column field="price1" label="Cost" >
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price1 }}
                        </a>
                    </template>
                </b-table-column>

                 <b-table-column field="price2" label="Paid" >
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price2 }}
                        </a>
                    </template>
                </b-table-column>

                 <b-table-column field="price3" label="Customer" >
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price3 }}
                        </a>
                    </template>
                </b-table-column>

                <b-table-column field="price4" label="Located" >
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price4 }}
                        </a>
                    </template>
                </b-table-column>

                <b-table-column field="price5" label="Deadline" >
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price5 }}
                        </a>
                    </template>
                </b-table-column>

            </template>

            <template slot="detail" slot-scope="props">
                <br>
                    <form action="">
                        <div class="container">
                            <div class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        <p class="subtitle is-5">Edit Item</p>
                                    </div>
                                    <div class="level-item">
                                        <p class="subtitle is-5">ID {{props.row.id}}</p>
                                    </div>
                                    <div class="level-item"></div>
                                    <div class="level-item">
                                        <p>Details {{props.row.price1}}, {{props.row.price2}}</p>
                                    </div>
                                </div>
                                <div class="level-right">
                                    <div class="level-item">
                                         <b-button type="is-danger">
                                            <v-icon name="trash" scale="0.7"/> Delete
                                        </b-button>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                    <div class="column">
                                        <p>Name</p>
                                    </div>
                                    <div class="column">
                                        <b-input type="text" name="name" v-model="props.row.name"></b-input>
                                    </div>
                                    <div class="column is-one-fifth"></div>
                                    <div class="column">
                                        <p>Price</p>
                                    </div>
                                   <div class="column">
                                        <b-input type="text" name="price" v-model="props.row.price"></b-input>
                                   </div>
                                   <div class="column"></div>
                            </div>
                            <div class="columns">
                                    <div class="column">
                                        <p>Status</p>
                                    </div>
                                    <div class="column">
                                        <b-select v-model="props.row.status">
                                                <option v-bind:value="props.row.status" disabled hidden>{{props.row.status}}</option>
                                                <option value="3_optn2">3_optn2</option>
                                                <option value="3_optn3">3_optn3</option>
                                        </b-select>
                                    </div>
                                    <div class="column is-one-fifth"></div>
                                    <div class="column">
                                        <p>Main4</p>
                                    </div>
                                   <div class="column">
                                        <b-select v-model="props.row.price1">
                                                <option v-bind:value="props.row.price1" disabled hidden>{{props.row.price1}}</option>
                                                <option value="canceled">canceled</option>
                                                <option value="in work">in work</option>
                                        </b-select>
                                   </div>
                                   <div class="column"></div>
                            </div>
                             <div class="level">
                                 <div class="level-left"></div>
                                 <div class="level-right">
                                     <div class="level-item">
                                         <b-button type="is-primary">Save</b-button>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </form>
            </template>

            </b-table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        data: function(){
            return{
                data: [],
                defaultOpenedDetails: [0],
                activeTab: 0
            }
        },
        methods: {
            getData(){
                var data = [];
                for(var i = 0; i < 100; i++){
                   var item = {
                       'id': i,
                       'name' : 'name_' + i,
                       'status': 'in work',
                       'age': i,
                       'price': i + ' EUR',
                       'price1': i + ' EUR',
                       'price2': i + ' EUR',
                       'price3': i + ' EUR',
                       'price4': i + ' EUR',
                       'price5': i + ' EUR'
                   }
                   data.push(item);
                }
                this.data = data;
            },
            toggle(row) {
                this.$refs.table.toggleDetails(row)
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>
