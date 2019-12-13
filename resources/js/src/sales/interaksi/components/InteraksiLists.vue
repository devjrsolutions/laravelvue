<template>
    <div class="component-wrap">

        <!-- search -->
        <v-card class="pt-3">
            <div class="d-flex flex-row">
                <div class="flex-grow-1 pa-2">
                    <v-btn @click="$router.push({name:'interaksi.create'})" class="primary lighten-1" dark>
                        Tambah Interaksi
                        <v-icon right dark>add</v-icon>
                    </v-btn>
                </div>
            </div>
            <div class="d-flex flex-lg-row flex-sm-column">
                <div class="flex-grow-1 pa-2">
                    <v-text-field filled prepend-icon="search" label="Cari Pasien" v-model="filters.name"></v-text-field>
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
                        <!-- <span v-if="header.value=='name'"><v-icon>mdi-person</v-icon> {{header.text}}</span> -->
                        <span v-if="header.value=='company_id'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <!-- <span v-if="header.value=='email'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='phone'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='advertise_id'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='phone_wa'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='age'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='gender_code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='address'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='status'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='complain'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='remark'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='pasien_status_id'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='created_by'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='created_at'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='updated_by'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='updated_at'"><v-icon>mdi-person</v-icon> {{header.text}}</span> -->
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
                                <v-btn @click="$router.push({name:'interaksi.edit',params:{id: item.id}})" class="ma-2" outlined fab small color="info">
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn @click="trash(item)" class="ma-2" outlined fab small color="red">
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </div>
                        </td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.company_id }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.phone_wa }}</td>
                        <td>{{ item.age }}</td>
                        <td>{{ item.advertise_id }}</td>
                        <td>{{ item.gender_code }}</td>
                        <td>{{ item.address }}</td>
                        <td>{{ item.status }}</td>
                        <td>{{ item.complain }}</td>
                        <td>{{ item.remark }}</td>
                        <td>{{ item.pasien_status_id }}</td>
                        <td>{{ $appFormatters.formatDate(item.created_at) }}</td>
                        <td>{{ $appFormatters.formatDate(item.updated_at) }}</td>
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
                    { text: 'Name', value: 'name', align: 'left', sortable: false },
                    { text: 'Company Id', value: 'comapany_id', align: 'left', sortable: false },
                    { text: 'Email', value: 'email', align: 'left', sortable: false },
                    { text: 'Phone', value: 'phone', align: 'left', sortable: false },
                    { text: 'Phone WA', value: 'phone_wa', align: 'left', sortable: false },
                    { text: 'Umur', value: 'age', align: 'left', sortable: false },
                    { text: 'Advertise ID', value: 'advertise_id', align: 'left', sortable: false },
                    { text: 'Gender Code', value: 'gender_code', align: 'left', sortable: false },
                    { text: 'Alamat', value: 'address', align: 'left', sortable: false },
                    { text: 'Status', value: 'status', align: 'left', sortable: false },
                    { text: 'Complain', value: 'complain', align: 'left', sortable: false },
                    { text: 'Remark', value: 'remark', align: 'left', sortable: false },
                    { text: 'Pasien Status ID', value: 'pasien_status_id', align: 'left', sortable: false },
                    { text: 'Created At', value: 'created_at', align: 'left', sortable: false },
                    { text: 'Updated At', value: 'updated_at', align: 'left', sortable: false },
                ],
                items: [],
                totalItems: 0,
                pagination: {
                    rowsPerPage: 10
                },

                filters: {
                    name: '',
                    company_id: '',
                    email: '',
                    phone: '',
                    phone_wa: '',
                    age: '',
                    advertise_id: '',
                    gender_code: '',
                    address: '',
                    status: '',
                    complain: '',
                    remark: '',
                    pasien_status_id: '',
                    created_at: '',
                    updated_at: '',
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

            self.$eventBus.$on(['INTERAKSI_ADDED','INTERAKSI_UPDATED','INTERAKSI_DELETED','GROUP_ADDED'],()=>{
                self.loadInteraksi(()=>{});
            });

            self.$store.commit('setBreadcrumbs',[
                {label:'Interaksi',to:{name:'interaksi.list'}},
            ]);
        },
        watch: {
            'pagination.page':function(){
                this.loadInteraksi(()=>{});
            },
            'pagination.rowsPerPage':function(){
                this.loadInteraksi(()=>{});
            },
            'filters.name':_.debounce(function(){
                const self = this;
                self.loadInteraksi(()=>{});
            },700)
        },
        methods: {
            trash(interaksi) {
                const self = this;

                self.$store.commit('showDialog',{
                    type: "confirm",
                    icon: 'warning',
                    title: "Confirm Deletion",
                    message: "Are you sure you want to delete this interaksi?",
                    okCb: ()=>{

                        axios.delete('/system/interaksi/' + interaksi.id).then(function(response) {

                            self.$store.commit('showSnackbar',{
                                message: response.data.message,
                                color: 'success',
                                duration: 3000
                            });

                            self.$eventBus.$emit('INTERAKSI_DELETED');

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
                    case 'interaksi_permissions':
                        self.dialogs.showPermissions.items = data;
                        setTimeout(()=>{
                            self.dialogs.showPermissions.show = true;
                        },500);
                    break;
                }
            },
            loadInteraksi(cb) {
                const self = this;

                let params = {
                    name: self.filters.name,
                    page: self.pagination.page,
                    per_page: self.pagination.rowsPerPage
                };

                axios.get('/system/interaksi',{params: params}).then(function(response) {
                    self.items = response.data.data.data;
                    self.totalItems = response.data.data.total;
                    self.pagination.totalItems = response.data.data.total;
                    (cb || Function)();
                });
            }
        }
    }
</script>