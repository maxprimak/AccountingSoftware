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
                    <div class="level">
                        <div class="level-right">
                            <div class="level-item" style="width: 100%">
                            <b-input placeholder="Search..."
                            type="search"
                            size="is-small"
                            icon="magnify" rounded>
                            </b-input>
                            </div>


                        </div>
                        <div class="level-left">
                            <a href="/repair-orders/create" class="btn btn-primary" style="margin-right: 22%">ADD NEW CLIENT</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>