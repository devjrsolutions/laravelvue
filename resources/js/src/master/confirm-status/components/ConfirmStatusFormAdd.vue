<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>person</v-icon> Create Interaksi
            </v-card-title>
            <v-divider></v-divider>
            <v-form v-model="valid" ref="userFormAdd" lazy-validation>
                <v-container grid-list-md>
                    <v-layout row wrap>
                    <v-flex xs12 sm3>
                        <v-text-field label="Code" v-model="code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm3>
                        <v-text-field label="Company Code" v-model="company_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm3>
                        <v-text-field label="Name" v-model="name" :rules="nameRules" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm3>
                        <v-text-field label="Status" v-model="status" ></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <v-btn @click="save()" :disabled="!valid" color="primary" dark>Save</v-btn>
                    </v-flex>
                </v-layout>
                </v-container>
            </v-form>
        </v-card>
    </div>
</template>

<script>
    export default {
        data() {

            const self = this;

            return {
                valid: false,
                name: '',
                nameRules: [
                    (v) => !!v || 'Name is required',
                ],
                alert: {
                    show: false,
                    icon: '',
                    color: '',
                    message: ''
                }
            }
        },
        mounted() {
            console.log('components.ConfirmStatusFormAdd.vue');

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'ConfirmStatus',to:{name:'confirmstatus.list'}},
                {label:'Create',to:''},
            ]);
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    code: self.code,
                    company_code: self.company_code,
                    name: self.name,
                    status: self.status,
                };

                self.$store.commit('showLoader');

                axios.post('/system/confirm-status',payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('CONFIRMSTATUS_ADDED');
                    self.$store.commit('hideLoader');

                    // reset
                    self.$refs.userFormAdd.reset();
                    // self.permissions = [];

                }).catch(function (error) {

                    self.$store.commit('hideLoader');

                    if (error.response) {
                        self.$store.commit('showSnackbar',{
                            message: error.response.data.message,
                            color: 'error',
                            duration: 3000
                        });
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
                });
            }
        }
    }
</script>