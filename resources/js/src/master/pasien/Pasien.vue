<template>
    <div class="page_wrap_vue pa-3">
        <!-- <h2>PAGE PASIEN</h2> -->
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('This is pasien');

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'Pasien',name:''}
            ]);
        }
    }
</script>