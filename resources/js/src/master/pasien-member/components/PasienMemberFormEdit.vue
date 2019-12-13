<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>person</v-icon> Edit Psien Member
            </v-card-title>
            <v-divider class="mb-2"></v-divider>
            <v-form v-model="valid" ref="pasienmemberFormEdit" lazy-validation>
                <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-text-field label="Code" v-model="code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Nama" v-model="name" :rules="nameRules" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Birthdate" v-model="Birthdate" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Alamat Email" v-model="email" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Phone" v-model="phone" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Phone_WA" v-model="phone_wa" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Member Card Code" v-model="member_card_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Advertise Code" v-model="advertise_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Age" v-model="age" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Gender Code" v-model="gender_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Job" v-model="job" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Address" v-model="address" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Photo" v-model="photo" ></v-text-field>
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
                        <v-text-field label="Pasien Status Code" v-model="pasien_status_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Confirm Status Code" v-model="confirm_status_code" ></v-text-field>
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
            propPasienMemberId: {
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

            this.loadPasienMember(()=>{});
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    code: self.code,
                    name: self.name,
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
                    create_by: self.create_by,
                    create_date: self.create_date,
                    confirm_by: self.confirm_by,
                    confirm_date: self.confirm_date,
                    confirm_status_code: self.confirm_status_code,
                
                };

                self.$store.commit('showLoader');

                axios.put('/system/pasien-member/'+self.propPasienMemberId,payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('PASIENMEMBER_UPDATED');
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
            loadPasienMember(cb) {

                const self = this;

                // reset first
                // self.groups = [];

                axios.get('/system/pasien-member/' + self.propPasienMemberId).then(function(response) {
                    let PasienMember = response.data.data;

                    self.code = PasienMember.code,
                    self.name = PasienMember.name,
                    self.birthdate = PasienMember.birthdate,
                    self.email = PasienMember.email,
                    self.phone = PasienMember.phone,
                    self.phone_wa = PasienMember.phone_wa,
                    self.member_card_code = PasienMember.member_card_code,
                    self.advertise_code = PasienMember.advertise_code,
                    self.age = PasienMember.age,
                    self.gender_code = PasienMember.gender_code,
                    self.job = PasienMember.job,
                    self.address = PasienMember.address,
                    self.photo = PasienMember.photo,
                    self.status = PasienMember.status,
                    self.complain = PasienMember.complain,
                    self.remark = PasienMember.remark,
                    self.pasien_status_code = PasienMember.pasien_status_code,
                    self.create_by = PasienMember.create_by,
                    self.create_date = PasienMember.create_date,
                    self.confirm_by = PasienMember.confirm_by,
                    self.confirm_date = PasienMember.confirm_date,
                    self.confirm_status_code = PasienMember.confirm_status_code,

                    self.$store.commit('setBreadcrumbs',[
                        {label:'PasienMember',to:{name:'pasienmember.list'}},
                        {label:PasienMember.name,to:''},
                        {label:'Edit',to:''},
                    ]);

                    cb();
                });
            }
        }
    }
</script>