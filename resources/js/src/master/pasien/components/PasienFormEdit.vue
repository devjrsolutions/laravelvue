<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>person</v-icon> Edit Pasien
            </v-card-title>
            <v-divider class="mb-2"></v-divider>
            <v-form v-model="valid" ref="pasienFormEdit" lazy-validation>
                <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-text-field label="Code" v-model="code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Nama" v-model="name" :rules="nameRules" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="klinik_code" v-model="klinik_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="birthdate" v-model="birthdate" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="email" v-model="email" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="phone" v-model="phone" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="phone_wa" v-model="phone_wa" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="member_card_code" v-model="member_card_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="advertise_code" v-model="advertise_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="age" v-model="age" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="gender_code" v-model="gender_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="job" v-model="job" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="address" v-model="address" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="photo" v-model="photo" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="status" v-model="status" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="complain" v-model="complain" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="remark" v-model="remark" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="pasien_status_code" v-model="pasien_status_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="confirm_status_code" v-model="confirm_status_code" ></v-text-field>
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
            propPasienId: {
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

            this.loadPasien(()=>{});
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    code: self.code,
                    name: self.name,
                    klinik_code: self.klinik_code,
                    birthdate: self.birthdate,
                    email: self.email,
                    phone: self.phone,
                    phone_wa: self.phone_wa,
                    member_card_code: self.member_card_code,
                    advertise_code: self.advertise_code,
                    age: self.age,
                    gender_code: self.gender_code,
                    job: self.job,
                    address: self.address,
                    photo: self.photo,
                    status: self.status,
                    complain: self.complain,
                    remark: self.remark,
                    pasien_status_code: self.pasien_status_code,
                    confirm_status_code: self.confirm_status_code,
                
                };

                self.$store.commit('showLoader');

                axios.put('/system/pasien/'+self.propPasienId,payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('PASIEN_UPDATED');
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
            loadPasien(cb) {

                const self = this;

                // reset first
                // self.groups = [];

                axios.get('/system/pasien/' + self.propPasienId).then(function(response) {
                    let Pasien = response.data.data;

                    self.code = Pasien.code;
                    self.name = Pasien.name;
                    self.klinik_code = Pasien.klinik_code;
                    self.birthdate = Pasien.birthdate;
                    self.email = Pasien.email;
                    self.phone = Pasien.phone;
                    self.phone_wa = Pasien.phone_wa;
                    self.member_card_code = Pasien.member_card_code;
                    self.advertise_code = Pasien.advertise_code;
                    self.age = Pasien.age;
                    self.gender_code = Pasien.gender_code;
                    self.job = Pasien.job;
                    self.address = Pasien.address;
                    self.photo = Pasien.photo;
                    self.status = Pasien.status;
                    self.complain = Pasien.complain;
                    self.remark = Pasien.remark;
                    self.pasien_status_code = Pasien.pasien_status_code;
                    self.confirm_status_code = Pasien.confirm_status_code;

                    self.$store.commit('setBreadcrumbs',[
                        {label:'Pasien',to:{name:'pasien.list'}},
                        {label:Pasien.name,to:''},
                        {label:'Edit',to:''},
                    ]);

                    cb();
                });
            }
        }
    }
</script>