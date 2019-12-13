<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>person</v-icon> Edit Interaksi
            </v-card-title>
            <v-divider class="mb-2"></v-divider>
            <v-form v-model="valid" ref="interaksiFormEdit" lazy-validation>
                <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-text-field label="Nama Lengkap" v-model="name" :rules="nameRules"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Company ID" v-model="company_id" ></v-text-field>
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
                    <v-flex xs12 sm6>
                        <v-text-field label="Pasien Status ID" v-model="pasien_status_id" ></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <v-btn @click="save()" :disabled="!valid" color="primary" dark>Update</v-btn>
                    </v-flex>
                </v-layout>
            </v-container>
            </v-form>
        </v-card>
    </div>
</template>

<script>
    export default {
        props: {
            propInteraksiId: {
                required: true
            }
        },
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
            const self = this;

            this.loadInteraksi(()=>{});
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
                    complain: self.complain,
                    remark: self.remark,
                    pasien_status_id: self.pasien_status_id,
                    status: self.status,
                
                };

                self.$store.commit('showLoader');

                axios.put('/system/interaksi/'+self.propInteraksiId,payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('INTERAKSI_UPDATED');
                    self.$store.commit('hideLoader');

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
            },
            loadInteraksi(cb) {

                const self = this;

                // reset first
                // self.groups = [];

                axios.get('/system/interaksi/' + self.propInteraksiId).then(function(response) {
                    let Interaksi = response.data.data;

                    self.name = Interaksi.name;
                    self.company_id = Interaksi.company_id;
                    self.email = Interaksi.email;
                    self.phone = Interaksi.phone;
                    self.phone_wa = Interaksi.company_id;
                    self.advertise_id = Interaksi.company_id;
                    self.gender_code = Interaksi.gender_code;
                    self.address = Interaksi.address;
                    self.complain = Interaksi.complain;
                    self.remark = Interaksi.remark;
                    self.pasien_status_id = Interaksi.pasien_status_id;
                    self.status = Interaksi.status;

                    self.$store.commit('setBreadcrumbs',[
                        {label:'Interaksi',to:{name:'interaksi.list'}},
                        {label:Interaksi.name,to:''},
                        {label:'Edit',to:''},
                    ]);

                    cb();
                });
            }
        }
    }
</script>