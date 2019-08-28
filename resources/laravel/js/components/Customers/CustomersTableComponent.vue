<template>
    <section>

        <b-field grouped group-multiline>
            <div class="control">
                <b-switch v-model="showDetailIcon">Show detail icon</b-switch>
            </div>
        </b-field>

        <b-table
            :data="data"
            ref="table"
            paginated
            per-page="5"
            :opened-detailed="defaultOpenedDetails"
            detailed
            detail-key="id"
            @details-open="(row, index) => $buefy.toast.open(`Expanded ${row.user.first_name}`)"
            :show-detail-icon="showDetailIcon"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page">

            <template slot-scope="props">
                <b-table-column field="id" label="ID" width="40" numeric>
                    {{ this.id }}
                </b-table-column>

                <b-table-column field="user.first_name" label="First Name" sortable>
                    <!-- <template v-if="showDetailIcon">
                        {{ this.first_name }}
                    </template> -->
                    <!-- <template v-else>
                        <a @click="toggle(props.row)">
                            {{ this.first_name }}
                        </a>
                    </template> -->
                </b-table-column>

                <b-table-column field="user.last_name" label="Last Name" sortable>
                    {{ this.last_name }}
                </b-table-column>

                <b-table-column field="date" label="Date" sortable centered>
                    <span class="tag is-success">
                        {{ new Date(props.row.date).toLocaleDateString() }}
                    </span>
                </b-table-column>

                <b-table-column label="Gender">
                    <span>
                        <b-icon pack="fas"
                            :icon="props.row.gender === 'Male' ? 'mars' : 'venus'">
                        </b-icon>
                        {{ this.first_name }}
                    </span>
                </b-table-column>
            </template>

            <template slot="detail" slot-scope="props">
                <article class="media">
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img src="/static/img/placeholder-128x128.png">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{ this.first_name }} {{ this.user.last_name }}</strong>
                                <small>@{{ this.first_name }}</small>
                                <small>31m</small>
                                <br>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Proin ornare magna eros, eu pellentesque tortor vestibulum ut.
                                Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
                            </p>
                        </div>
                    </div>
                </article>
            </template>
        </b-table>

    </section>
</template>

<script>

    export default {
        data() {
            return {
              id: 1,
              first_name: "Maxim",
              last_name: "Primak",
            }
        },
        methods: {
            toggle(row) {
                this.$refs.table.toggleDetails(row)
            }
        }
    }
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
