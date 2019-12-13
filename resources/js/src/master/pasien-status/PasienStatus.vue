<template>
    <div class="page_wrap_vue pa-3">
        <!-- <h2>PAGE PASIEN STATUS</h2> -->
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('This is pasien status');

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'PasienStatus',name:''}
            ]);
        }
    }
</script>