<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>person</v-icon> Edit Gender
            </v-card-title>
            <v-divider class="mb-2"></v-divider>
            <v-form v-model="valid" ref="genderFormEdit" lazy-validation>
                <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-text-field label="Code" v-model="code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Company Code" v-model="company_code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Nama" v-model="name" :rules="nameRules" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Status" v-model="status" ></v-text-field>
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
            propGenderId: {
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

            this.loadGender(()=>{});
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

                axios.put('/system/gender/'+self.propGenderId,payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('GENDER_UPDATED');
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
            loadGender(cb) {

                const self = this;

                // reset first
                // self.groups = [];

                axios.get('/system/gender/' + self.propGenderId).then(function(response) {
                    let Gender = response.data.data;

                    self.code = Gender.code;
                    self.company_code = Gender.company_code;
                    self.name = Gender.name;
                    self.status = Gender.status;

                    self.$store.commit('setBreadcrumbs',[
                        {label:'Gender',to:{name:'gender.list'}},
                        {label:Gender.name,to:''},
                        {label:'Edit',to:''},
                    ]);

                    cb();
                });
            }
        }
    }
</script>