<template>
    <b-table :data="data">
        <template slot-scope="props">
            <b-table-column field="name" label="Name">
                <b-input v-model="props.row.name"></b-input>
            </b-table-column>

            <b-table-column field="currency_id" label="Currency ID">
                <b-input v-model="props.row.currency_id"></b-input>
            </b-table-column>

            <b-table-column field="address" label="Address">
                <b-input v-model="props.row.address"></b-input>
            </b-table-column>

            <b-table-column field="phone" label="Phone">
                <b-input v-model="props.row.phone"></b-input>
            </b-table-column>

            <b-table-column field="phone" label="Phone">
                <b-button>Save</b-button>
            </b-table-column>
        </template>
    </b-table>
</template>

<script>
    export default {
        props:['companies'], 
        data() {
            return {
                data: this.companies
            }
        }
    }
</script>