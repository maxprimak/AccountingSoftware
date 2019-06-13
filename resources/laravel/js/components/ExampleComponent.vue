<template>
    <div class="container">
        <div class="row justify-content-center">
            <b-table
            :data="data"
            ref="table"
            paginated
            per-page="10"
            :opened-detailed="defaultOpenedDetails"
            detailed
            detail-key="id"
            @details-open="(row, index) => $toast.open(`Expanded ${row.user.first_name}`)"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page">

            <template slot-scope="props">
                
                <b-table-column field="id" label="ID" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.id }}
                        </a>
                </template>
                </b-table-column>

                <b-table-column field="name" label="Name" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.name }}
                        </a>
                </template>
                </b-table-column>

                <b-table-column field="status" label="status" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.status }}
                        </a>
                    </template>
                </b-table-column>

                <b-table-column field="age" label="age" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.age }}
                        </a>
                </template>
                </b-table-column>

                <b-table-column field="price" label="price" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price }}
                        </a>
                    </template>
                </b-table-column>

                 <b-table-column field="price1" label="price1" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price1 }}
                        </a>
                    </template>
                </b-table-column>

                 <b-table-column field="price2" label="price2" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price2 }}
                        </a>
                    </template>
                </b-table-column>

                 <b-table-column field="price3" label="price3" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price3 }}
                        </a>
                    </template>
                </b-table-column>

                <b-table-column field="price4" label="price4" width="40" numeric>
                    <template>
                        <a @click="toggle(props.row)">
                            {{ props.row.price4 }}
                        </a>
                    </template>
                </b-table-column>

                <b-table-column field="price5" label="price5" width="40" numeric>
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
                                        <b-dropdown hoverable aria-role="list">
                                            <button class="button is-light" type="button" slot="trigger">
                                                <v-icon name="print" />
                                            </button>

                                            <b-dropdown-item aria-role="listitem">Ticket</b-dropdown-item>
                                            <b-dropdown-item aria-role="listitem">Check</b-dropdown-item>
                                            <b-dropdown-item aria-role="listitem">Warranty</b-dropdown-item>
                                            <b-dropdown-item aria-role="listitem">Invoice</b-dropdown-item>
                                        </b-dropdown>
                                    </div>
                                    <div class="level-item">
                                        <b-dropdown hoverable aria-role="list" position="is-bottom-left">
                                            <button class="button is-light" type="button" slot="trigger">
                                                <v-icon name="history" />
                                            </button>
                                            <b-tabs v-model="activeTab">
                                                <b-tab-item :visible="showBooks" label="History">
                                                    <b-dropdown-item aria-role="listitem">Skywalker changed Payment method to Card</b-dropdown-item>
                                                    <b-dropdown-item aria-role="listitem">Skywalker changed Total price to 12.33 EUR</b-dropdown-item>
                                                    <b-dropdown-item aria-role="listitem">Skywalker changed Payment method to Card</b-dropdown-item>
                                                    <b-dropdown-item aria-role="listitem">Skywalker changed Payment method to Card</b-dropdown-item>
                                                </b-tab-item>

                                                <b-tab-item label="Comments">
                                                        <b-dropdown-item aria-role="listitem">Here you can edit comments related to an order</b-dropdown-item>
                                                        <b-input maxlength="500" type="textarea"></b-input>
                                                        <div class="level-left"></div>
                                                        <div class="level-right">
                                                            <button type="button" class="button is-primary">Publish</button>
                                                        </div>
                                                </b-tab-item>
                                            </b-tabs>
                                        </b-dropdown>
                                    </div>
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
                defaultOpenedDetails: [1]
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
