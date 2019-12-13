<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>assignment</v-icon> Create Interaksi
            </v-card-title>
            <v-divider></v-divider>
            <v-form v-model="valid" ref="userFormAdd" lazy-validation>
                <v-container grid-list-md>
                    <v-layout row wrap xs12 sm6>
                        <v-flex xs12 sm6>
                            <v-text-field label="Nama" v-model="name" :rules="nameRules"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-overflow-btn
                                v-model="company_id"
                                :items="dropdown_edit"
                                label="Company"
                                editable
                                item-value="text"
                            ></v-overflow-btn>
                            <!-- <v-text-field label="Company ID" v-model="company_id" ></v-text-field> -->
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Email" v-model="email" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Phone" v-model="phone" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Phone WA" v-model="phone_wa" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Umur" v-model="age" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Advertise ID" v-model="advertise_id" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Gender Code" v-model="gender_code" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Address" v-model="address" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Status" v-model="status" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Complain" v-model="complain" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-text-field label="Remark" v-model="remark" ></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-text-field label="Pasien Status ID" v-model="pasien_status_id" ></v-text-field>
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
                },
                dropdown_edit: [
                    { text: '100%' },
                    { text: '75%' },
                    { text: '50%' },
                    { text: '25%' },
                    { text: '0%' },
                ]
            }
        },
        mounted() {
            console.log('components.InteraksiFormAdd.vue');

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'Interaksi',to:{name:'interaksi.list'}},
                {label:'Create',to:''},
            ]);
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    name: self.name,
                    company_id: self.company_id,
                    email: self.email,
                    phone: self.phone,
                    phone_wa: self.phone_wa,
                    age: self.age,
                    advertise_id: self.advertise_id,
                    gender_code: self.gender_code,
                    address: self.address,
                    status: self.status,
                    complain: self.complain,
                    remark: self.remark,
                    pasien_status_id: self.pasien_status_id,
                };

                self.$store.commit('showLoader');

                axios.post('/system/interaksi',payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('INTERAKSI_ADDED');
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