<template>
    <div class="page_wrap_vue pa-3">
        <!-- <h2>PAGE CONFIRMSTATUS</h2> -->
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('This is confirmstatus');

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'ConfirmStatus',name:''}
            ]);
        }
    }
</script>