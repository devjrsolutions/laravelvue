<template>
    <div class="component-wrap">

        <!-- search -->
        <v-card class="pt-3">
            <div class="d-flex flex-row">
                <div class="flex-grow-1 pa-2">
                    <v-btn @click="$router.push({name:'membercard.create'})" class="primary lighten-1" dark>
                        Tambah Member Card
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
                        <span v-if="header.value=='company_code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='name'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        <span v-if="header.value=='member_fiture_code'"><v-icon>mdi-person</v-icon> {{header.text}}</span>
                        
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
                                <v-btn @click="$router.push({name:'membercard.edit',params:{id: item.id}})" class="ma-2" outlined fab small color="info">
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn @click="trash(item)" class="ma-2" outlined fab small color="red">
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </div>
                        </td>
                        <td>{{ item.code }}</td>
                        <td>{{ item.company_code }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.member_fiture_code }}</td>
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
                    { text: 'Company Code', value: 'company_code', align: 'left', sortable: false },
                    { text: 'Name', value: 'name', align: 'left', sortable: false },
                    { text: 'Member Fiture Code', value: 'member_fiture_code', align: 'left', sortable: false },
                ],
                items: [],
                totalItems: 0,
                pagination: {
                    rowsPerPage: 10
                },

                filters: {
                    code: '',
                    company_code: '',
                    name: '',
                    member_fiture_code: '',
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

            self.$eventBus.$on(['MEMBERCARD_ADDED','MEMBERCARD_UPDATED','MEMBERCARD_DELETED','GROUP_ADDED'],()=>{
                self.loadMemberCard(()=>{});
            });

            self.$store.commit('setBreadcrumbs',[
                {label:'MemberCard',to:{name:'membercard.list'}},
            ]);
        },
        watch: {
            'pagination.page':function(){
                this.loadMemberCard(()=>{});
            },
            'pagination.rowsPerPage':function(){
                this.loadMemberCard(()=>{});
            },
            'filters.name':_.debounce(function(){
                const self = this;
                self.loadMemberCard(()=>{});
            },700)
        },
        methods: {
            trash(membercard) {
                const self = this;

                self.$store.commit('showDialog',{
                    type: "confirm",
                    icon: 'warning',
                    title: "Confirm Deletion",
                    message: "Are you sure you want to delete this membercard?",
                    okCb: ()=>{

                        axios.delete('/system/member-card/' + membercard.id).then(function(response) {

                            self.$store.commit('showSnackbar',{
                                message: response.data.message,
                                color: 'success',
                                duration: 3000
                            });

                            self.$eventBus.$emit('MEMBERCARD_DELETED');

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
                    case 'membercard_permissions':
                        self.dialogs.showPermissions.items = data;
                        setTimeout(()=>{
                            self.dialogs.showPermissions.show = true;
                        },500);
                    break;
                }
            },
            loadMemberCard(cb) {
                const self = this;

                let params = {
                    name: self.filters.name,
                    page: self.pagination.page,
                    per_page: self.pagination.rowsPerPage
                };

                axios.get('/system/member-card',{params: params}).then(function(response) {
                    self.items = response.data.data.data;
                    self.totalItems = response.data.data.total;
                    self.pagination.totalItems = response.data.data.total;
                    (cb || Function)();
                });
            }
        }
    }
</script>