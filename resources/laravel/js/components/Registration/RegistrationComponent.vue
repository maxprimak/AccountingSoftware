<template>
    <b-steps>
        <b-step-item label="Person">
            <div class="columns is-centered">
                <div class="column is-one-quarter">
                    <h3 class="title has-text-centered">Add your personal info</h3>
                    <b-field label="Your name">
                        <b-input></b-input>
                    </b-field>
                    <b-field label="Your phone">
                        <b-input></b-input>
                    </b-field>
                    <b-field label="Your address">
                        <b-input></b-input>
                    </b-field>
                </div>
            </div>
        </b-step-item>
        <b-step-item label="Company">
            <div class="columns is-centered">
                <div class="column is-one-quarter">
                    <h3 class="title has-text-centered">Add your company info</h3>
                    <b-field label="Company name">
                        <b-input></b-input>
                    </b-field>
                    <b-field label="Company address">
                        <b-input></b-input>
                    </b-field>
                    <b-field label="Company phone">
                        <b-input></b-input>
                    </b-field>
                    <b-field label="Company currency">
                        <b-select>
                            <option selected>USD</option>
                        </b-select>
                    </b-field>
                </div>
            </div>
        </b-step-item>
    </b-steps>
</template>

<script>
    export default {
        data() {
            return {
                
            }
        }
    }
</script>