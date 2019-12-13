<template>
    <div class="component-wrap">

        <!-- search -->
        <v-card class="pt-3">
            <div class="d-flex flex-row">
                <div class="flex-grow-1 pa-2">
                    <v-btn @click="$router.push({name:'pasienmember.create'})" class="primary lighten-1" dark>
                        Tambah Pasien Member
                        <v-icon right dark>add</v-icon>
                    </v-btn>
                </div>
            </div>
            <div class="d-flex flex-lg-row flex-sm-column">
                <div class="flex-grow-1 pa-2">
                    <v-text-field filled prepend-icon="search" label="Cari Data" v-model="filters.name"></v-text-field>
                </div>
            </div>
        </v-card>
        <!-- /search -->

        <!-- data table -->
        <v-data-table
                hide-default-header
                v-bind:headers="headers"
                :options.sync="pagination"
                :items="items"
                :server-items-length="totalItems"
                class="elevation-1">
            <template v-slot:header="{props:{headers}}">
                <thead>
                <tr>
                    <th v-for="header in headers">
                        <span v-if="header.value=='code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='name'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='birthdate'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='email'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='phone'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='phone_wa'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='member_card_code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='advertise_code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='age'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='gender_code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='job'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='address'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='photo'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='status'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='complain'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='remark'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='pasien_status_code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='confirm_status_code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>

                        
                        <span v-else>{{header.text}}</span>
                    </th>
                </tr>
                </thead>
            </template>
            <template v-slot:body="{items}">
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td>
                            <div class="text-center">
                                <v-btn @click="$router.push({name:'pasienmember.edit',params:{id: item.id}})" class="ma-2" outlined fab small color="info">
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn @click="trash(item)" class="ma-2" outlined fab small color="red">
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </div>
                        </td>
                        <td>{{ item.code }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.birthdate }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.phone_wa }}</td>
                        <td>{{ item.member_card_code }}</td>
                        <td>{{ item.advertise_code }}</td>
                        <td>{{ item.age }}</td>
                        <td>{{ item.gender_code }}</td>
                        <td>{{ item.job }}</td>
                        <td>{{ item.address }}</td>
                        <td>{{ item.photo }}</td>
                        <td>{{ item.status }}</td>
                        <td>{{ item.complain }}</td>
                        <td>{{ item.remark }}</td>
                        <td>{{ item.pasien_status_code }}</td>
                        <td>{{ item.confirm_status_code }}</td>

                    </tr>
                </tbody>
            </template>
        </v-data-table>

    </div>
</template>

<script>
    export default {
        data () {
            return {
                headers: [
                    { text: 'Action', value: false, align: 'left', sortable: false },
                    { text: 'Code', value: 'code', align: 'left', sortable: false },
                    { text: 'Name', value: 'name', align: 'left', sortable: false },
                    { text: 'Birthdate', value: 'birthdate', align: 'left', sortable: false },
                    { text: 'Email', value: 'email', align: 'left', sortable: false },
                    { text: 'Phone', value: 'phone', align: 'left', sortable: false },
                    { text: 'Phone_WA', value: 'phone_wa', align: 'left', sortable: false },
                    { text: 'Member Card Code', value: 'member_card_code', align: 'left', sortable: false },
                    { text: 'Advertise Code', value: 'advertise_code', align: 'left', sortable: false },
                    { text: 'Age', value: 'age', align: 'left', sortable: false },
                    { text: 'Gender Code', value: 'gender_code', align: 'left', sortable: false },
                    { text: 'Job', value: 'job', align: 'left', sortable: false },
                    { text: 'Address', value: 'address', align: 'left', sortable: false },
                    { text: 'Photo', value: 'photo', align: 'left', sortable: false },
                    { text: 'Status', value: 'status', align: 'left', sortable: false },
                    { text: 'Complain', value: 'complain', align: 'left', sortable: false },
                    { text: 'Remark', value: 'remark', align: 'left', sortable: false },
                    { text: 'Pasien Status Code', value: 'pasien_status_code', align: 'left', sortable: false },
                    { text: 'Confirm Status Code', value: 'confirm_status_code', align: 'left', sortable: false },
                ],
                items: [],
                totalItems: 0,
                pagination: {
                    rowsPerPage: 10
                },

                filters: {
                    code: '',
                    name: '',
                    birthdate: '',
                    email: '',
                    phone: '',
                    phone_wa: '',
                    member_card_code: '',
                    advertise_code: '',
                    age: '',
                    gender_code: '',
                    job: '',
                    address: '',
                    photo: '',
                    status: '',
                    complain: '',
                    remark: '',
                    pasien_status_code: '',
                    confirm_status_code: '',
                },
                dialogs: {
                    showPermissions: {
                        items: [],
                        show: false
                    }
                }
            }
        },
        mounted() {
            const self = this;

            self.$eventBus.$on(['PASIENMEMBER_ADDED','PASIENMEMBER_UPDATED','PASIENMEMBER_DELETED','GROUP_ADDED'],()=>{
                self.loadPasienMember(()=>{});
            });

            self.$store.commit('setBreadcrumbs',[
                {label:'PasienMember',to:{name:'pasienmember.list'}},
            ]);
        },
        watch: {
            'pagination.page':function(){
                this.loadPasienMember(()=>{});
            },
            'pagination.rowsPerPage':function(){
                this.loadPasienMember(()=>{});
            },
            'filters.name':_.debounce(function(){
                const self = this;
                self.loadPasienMember(()=>{});
            },700)
        },
        methods: {
            trash(pasienmember) {
                const self = this;

                self.$store.commit('showDialog',{
                    type: "confirm",
                    icon: 'warning',
                    title: "Confirm Deletion",
                    message: "Are you sure you want to delete this pasienmember?",
                    okCb: ()=>{

                        axios.delete('/system/pasien-member/' + pasienmember.id).then(function(response) {

                            self.$store.commit('showSnackbar',{
                                message: response.data.message,
                                color: 'success',
                                duration: 3000
                            });

                            self.$eventBus.$emit('PASIENMEMBER_DELETED');

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
                    cancelCb: ()=>{
                        console.log("CANCEL");
                    }
                });
            },
            showDialog(dialog, data) {

                const self = this;
                switch (dialog){
                    case 'pasienmember_permissions':
                        self.dialogs.showPermissions.items = data;
                        setTimeout(()=>{
                            self.dialogs.showPermissions.show = true;
                        },500);
                    break;
                }
            },
            loadPasienMember(cb) {
                const self = this;

                let params = {
                    name: self.filters.name,
                    page: self.pagination.page,
                    per_page: self.pagination.rowsPerPage
                };

                axios.get('/system/pasien-member',{params: params}).then(function(response) {
                    self.items = response.data.data.data;
                    self.totalItems = response.data.data.total;
                    self.pagination.totalItems = response.data.data.total;
                    (cb || Function)();
                });
            }
        }
    }
</script>