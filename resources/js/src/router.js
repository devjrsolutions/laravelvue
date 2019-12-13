import Vue from 'vue';
import Router from 'vue-router';
import store from '../common/Store';


Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: '/',
            redirect: '/dashboard',
        },
        {
            name: 'dashboard',
            path: '/dashboard',
            component: require('./dashboard/Home'),
        },
        {
            path: '/interaksi',
            component: require('./sales/interaksi/Interaksi'),
            children: [
                {
                    path:'/',
                    name:'interaksi.list',
                    component: require('./sales/interaksi/components/InteraksiLists')
                },
                {
                    path:'create',
                    name:'interaksi.create',
                    component: require('./sales/interaksi/components/InteraksiFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'interaksi.edit',
                    component: require('./sales/interaksi/components/InteraksiFormEdit'),
                    props: (route) => ({propInteraksiId: route.params.id}),
                }
            ]
        },
        {
            path: '/users',
            component: require('./security/users/Users'),
            children: [
                {
                    path:'/',
                    name:'users.list',
                    component: require('./security/users/components/UserLists')
                },
                {
                    path:'create',
                    name:'users.create',
                    component: require('./security/users/components/UserFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'users.edit',
                    component: require('./security/users/components/UserFormEdit'),
                    props: (route) => ({propUserId: route.params.id}),
                },
                {
                    path:'groups',
                    name:'users.groups.list',
                    component: require('./security/users/components/GroupLists')
                },
                {
                    path:'groups/create',
                    name:'users.groups.create',
                    component: require('./security/users/components/GroupFromAdd')
                },
                {
                    path:'groups/edit/:id',
                    name:'users.groups.edit',
                    component: require('./security/users/components/GroupFromEdit'),
                    props: (route) => ({propGroupId: route.params.id}),
                },
                {
                    path:'permissions',
                    name:'users.permissions.list',
                    component: require('./security/users/components/PermissionLists')
                },
                {
                    path:'permissions/create',
                    name:'users.permissions.create',
                    component: require('./security/users/components/PermissionFormAdd')
                },
                {
                    path:'permissions/edit/:id',
                    name:'users.permissions.edit',
                    component: require('./security/users/components/PermissionFormEdit'),
                    props: (route) => ({propPermissionId: route.params.id}),
                },
            ]
        },
        {
            name: 'files',
            path: '/files',
            component: require('./security/files/Files'),
        },
        {
            path: '/advertise',
            component: require('./master/advertise/Advertise'),
            
            children: [
                {
                    path:'/',
                    name:'advertise.list',
                    component: require('./master/advertise/components/AdvertiseLists')
                },
                {
                    path:'create',
                    name:'advertise.create',
                    component: require('./master/advertise/components/AdvertiseFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'advertise.edit',
                    component: require('./master/advertise/components/AdvertiseFormEdit'),
                    props: (route) => ({propAdvertiseId: route.params.id}),
                }
            ]
        },

        {
            name: 'master',
            path: '/master',
            component: require('./master/Master'),
        },

        {
            name: 'dropdown',
            path: '/dropdown',
            component: require('./master/Dropdown'),
        },

        {
            path: '/confirmstatus',
            component: require('./master/confirm-status/ConfirmStatus'),
            
            children: [
                {
                    path:'/',
                    name:'confirmstatus.list',
                    component: require('./master/confirm-status/components/ConfirmStatusLists')
                },
                {
                    path:'create',
                    name:'confirmstatus.create', 
                    component: require('./master/confirm-status/components/ConfirmStatusFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'confirmstatus.edit',
                    component: require('./master/confirm-status/components/ConfirmStatusFormEdit'),
                    props: (route) => ({propConfirmStatusId: route.params.id}),
                }
            ]
        },
        {
            path: '/gender',
            component: require('./master/gender/Gender'),

            children: [
                {
                    path:'/',
                    name:'gender.list',
                    component: require('./master/gender/components/GenderLists')
                },
                {
                    path:'create',
                    name:'gender.create',
                    component: require('./master/gender/components/GenderFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'gender.edit',
                    component: require('./master/gender/components/GenderFormEdit'),
                    props: (route) => ({propGenderId: route.params.id}),
                }
            ]
        },
        {
            path: '/membercard',
            component: require('./master/member-card/MemberCard'),

            children: [
                {
                    path:'/',
                    name:'membercard.list',
                    component: require('./master/member-card/components/MemberCardLists')
                },
                {
                    path:'create',
                    name:'membercard.create',
                    component: require('./master/member-card/components/MemberCardFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'membercard.edit',
                    component: require('./master/member-card/components/MemberCardFormEdit'),
                    props: (route) => ({propMemberCardId: route.params.id}),
                }
            ]
        },
        {
            path: '/pasien',
            component: require('./master/pasien/Pasien'),
            
            children: [
                {
                    path:'/',
                    name:'pasien.list',
                    component: require('./master/pasien/components/PasienLists')
                },
                {
                    path:'create',
                    name:'pasien.create',
                    component: require('./master/pasien/components/PasienFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'pasien.edit',
                    component: require('./master/pasien/components/PasienFormEdit'),
                    props: (route) => ({propPasienId: route.params.id}),
                }
            ]
        },
        {
            path: '/pasienmember',
            component: require('./master/pasien-member/PasienMember'),

            children: [
                {
                    path:'/',
                    name:'pasienmember.list',
                    component: require('./master/pasien-member/components/PasienMemberLists')
                },
                {
                    path:'create',
                    name:'pasienmember.create',
                    component: require('./master/pasien-member/components/PasienMemberFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'pasienmember.edit',
                    component: require('./master/pasien-member/components/PasienMemberFormEdit'),
                    props: (route) => ({propPasienMemberId: route.params.id}),
                }
            ]
        },
        {
            path: '/pasien-status',
            component: require('./master/pasien-status/PasienStatus'),

            children: [
                {
                    path:'/',
                    name:'pasienstatus.list',
                    component: require('./master/pasien-status/components/PasienStatusLists')
                },
                {
                    path:'create',
                    name:'pasienstatus.create',
                    component: require('./master/pasien-status/components/PasienStatusFormAdd')
                },
                {
                    path:'edit/:id',
                    name:'pasienstatus.edit',
                    component: require('./master/pasien-status/components/PasienStatusFormEdit'),
                    props: (route) => ({propPasienStatusId: route.params.id}),
                }
            ]
        },
        {
            name: 'settings',
            path: '/settings',
            component: require('./security/settings/Settings'),
        }
    ],
});

router.beforeEach((to, from, next) => {
    store.commit('showLoader');
    next();
});

router.afterEach((to, from) => {
    setTimeout(()=>{
        store.commit('hideLoader');
    },1000);
});

export default router;