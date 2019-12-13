<template>
    <div class="page_wrap_vue pa-3">
        <!-- <h2>PAGE MEMBERCARD</h2> -->
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('This is membercard');

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'MemberCard',name:''}
            ]);
        }
    }
</script>