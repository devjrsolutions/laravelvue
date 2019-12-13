<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>person</v-icon> Edit Advertise
            </v-card-title>
            <v-divider class="mb-2"></v-divider>
            <v-form v-model="valid" ref="advertiseFormEdit" lazy-validation>
                <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-text-field label="Code" v-model="code" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Sort No" v-model="sort_no" ></v-text-field>
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
            propAdvertiseId: {
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

            this.loadAdvertise(()=>{});
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    code: self.code,
                    sort_no: self.sort_no,
                    company_code: self.company_code,
                    name: self.name,
                    status: self.status,
                
                };

                self.$store.commit('showLoader');

                axios.put('/system/advertise/'+self.propAdvertiseId,payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('ADVERTISE_UPDATED');
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
            loadAdvertise(cb) {

                const self = this;

                // reset first
                // self.groups = [];

                axios.get('/system/advertise/' + self.propAdvertiseId).then(function(response) {
                    let Advertise = response.data.data;

                    self.code = Advertise.code;
                    self.sort_no = Advertise.sort_no;
                    self.company_code = Advertise.company_code;
                    self.name = Advertise.name;
                    self.status = Advertise.status;

                    self.$store.commit('setBreadcrumbs',[
                        {label:'Advertise',to:{name:'advertise.list'}},
                        {label:Advertise.name,to:''},
                        {label:'Edit',to:''},
                    ]);

                    cb();
                });
            }
        }
    }
</script>