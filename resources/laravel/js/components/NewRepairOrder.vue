<template>
    <div class="container">
            <div class="columns">
                <div class="column is-5" style="border-right: 1px solid gray;">
                    <div class="level">
                        <div class="level-left"><p class="title is-4">New repair order</p></div>
                        <div class="level-right"><p class="title" style="font-size: 14px;">ID3675</p></div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <p style="color:gray">1.Client</p>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <p class="subtitle" style="font-size: 14px;">Johnson Michael  0-1234-56789</p>
                            </div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item">
                                <v-icon name="check-circle" scale="1.5" style="color: rgb(126,188,101)"></v-icon>
                            </div>
                        </div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <p style="color:gray">2.Device</p>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <p class="subtitle" style="font-size: 14px;">iPhone XR   A12345</p>
                            </div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item">
                                <v-icon name="check-circle" scale="1.5" style="color: rgb(126,188,101)"></v-icon>
                            </div>
                        </div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <p style="color:gray">3.Service</p>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <p class="subtitle" style="font-size: 14px;">Change Display</p>
                            </div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item">
                                <v-icon name="check-circle" scale="1.5" style="color: rgb(126,188,101)"></v-icon>
                            </div>
                        </div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <p style="font-weight: bold">4.Order Type</p>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <p class="subtitle" style="font-size: 14px;">Pay</p>
                            </div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item">
                                <v-icon name="check-circle" scale="1.5" style="color: rgb(126,188,101)"></v-icon>
                            </div>
                        </div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <p style="font-weight: bold">5.Payment method</p>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <p class="subtitle" style="font-size: 14px;">Card</p>
                            </div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item"></div>
                            <div class="level-item">
                                <v-icon name="check-circle" scale="1.5" style="color: rgb(126,188,101)"></v-icon>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 4%"></div>
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <p style="font-weight: bold">Discount code</p>
                            </div>
                        </div>
                        <div class="level-right">
                                <select class="form-control" style="border-radius:50px;" placeholder="31745sakfdj">
                                    <option value="salksdsafd">ksladasdfdas</option>
                                </select>
                            </div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                 <p style="font-weight: bold">Prepay sum</p>
                            </div>
                        </div>
                        <div class="level-right">
                            <input class="form-control" style="border-radius:50px; width: 50%" value="$5" />
                        </div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                 <p style="font-weight: bold">Total price</p>
                            </div>
                        </div>
                        <div class="level-right">
                            <input class="form-control" style="border-radius:50px; width: 50%" value="$58" />
                        </div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                 <p style="font-weight: bold">Estimated date</p>
                            </div> 
                        </div>
                        <div class="level-right">
                                <input class="form-control" style="border-radius:50px; width: 70%" value="20.06.2019" />
                        </div>
                    </div>
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <p style="font-weight: bold">Comment</p>
                            </div>
                        </div>                            
                        <div class="level-right">
                            <textarea class="form-control" style="border-radius:10px; width: 100%;" value="20.06.2019" />
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="columns">
                        <div class="column">
                            <b-input placeholder="Search..."
                            type="search"
                            size="is-small"
                            icon="magnify" rounded>
                            </b-input>
                        </div>
                        <div class="column">
                            <div class="level">
                            <div class="level-left"></div>
                            <div class="level-right">
                            <a href="/repair-orders/create" class="btn btn-primary">ADD NEW CLIENT</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="level">
                        <b-table
                        :data="data"
                        :columns="columns"
                        paginated
                        per-page="3"
                        style="width: 100%; font-family: Nunito;"></b-table>
                    </div>
                    <div class="level">
                        <p class="subtitle" style="font-weight: bold">Client device list</p>
                    </div>
                    <div class="level">
                        <b-table
                        :data="data"
                        :columns="columns"
                        style="width: 100%; font-family: Nunito;"></b-table>
                    </div>
                    <div class="row justify-content-center">
                            <v-icon name="plus-circle" scale="2" />
                    </div>
                        <div class="columns" style="margin-top: 5%">
                            <div class="column">
                                <label class="label" style="font-weight: bold" for="">Service</label>
                                <b-autocomplete
                                    rounded
                                    :data="data2"
                                    v-model="name"
                                    size="is-small"
                                    icon="magnify"
                                    @select="option => selected = option">
                                    <template slot="empty">No results found</template>
                                </b-autocomplete>
                            </div>
                            <div class="column" style="text-align: center;">
                                    <label class="label" style="font-weight: bold" for="">Order type</label>
                                    <button class="btn btn-primary btn-rounded" style="width: 50%; margin-bottom: 5%">Pay</button>
                                    <button class="btn btn-primary btn-rounded" style="width: 50%; margin-bottom: 5%">Warranty</button>
                                    <button class="btn btn-primary btn-rounded" style="width: 50%; margin-bottom: 5%">Rework</button>
                            </div>
                            <div class="column" style="text-align: right;">
                                    <label class="label" style="font-weight: bold" for="">Payment method</label>
                                    <button class="btn btn-primary btn-rounded" style="width: 50%; margin-bottom: 5%">Cash</button>
                                    <button class="btn btn-primary btn-rounded" style="width: 50%; margin-bottom: 5%">Card</button>
                            </div>
                        </div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: [
                    { 'id': 1, 'first_name': 'Jesse', 'last_name': 'Simmons', 'date': '2016-10-15 13:43:27', 'gender': 'Male' },
                    { 'id': 2, 'first_name': 'John', 'last_name': 'Jacobs', 'date': '2016-12-15 06:00:53', 'gender': 'Male' },
                    { 'id': 3, 'first_name': 'Tina', 'last_name': 'Gilbert', 'date': '2016-04-26 06:26:28', 'gender': 'Female' },
                    { 'id': 4, 'first_name': 'Clarence', 'last_name': 'Flores', 'date': '2016-04-10 10:28:46', 'gender': 'Male' }                ],
                    data2: [
                        'maxon',
                         'primakson'
                    ],
                     name: '',
                    selected: null,
                columns: [
                    {
                        field: 'id',
                        label: 'ID',
                        width: '40',
                        numeric: true
                    },
                    {
                        field: 'first_name',
                        label: 'First Name',
                    },
                    {
                        field: 'last_name',
                        label: 'Last Name',
                    },
                    {
                        field: 'date',
                        label: 'Date',
                        centered: true
                    }
                ]
            }
        }
    }
</script>