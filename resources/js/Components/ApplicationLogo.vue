<template>
    <img :src="appurl + '/images/logo-mini.png'" alt="Laravel Logo">
</template>


<script setup lang="ts">
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
const appurl = ref((usePage().props.url as { appurl: string }).appurl).value;

</script>