<template>
    <div v-if="links && links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, k) in props.links" :key="k">

                <Link :preserve-state="true" :class="{
                    'mr-1 mb-1 px-4 py-3 font-normal text-xs  text-gray-400 border rounded cursor-default': link.url === null,
                    'mr-1 mb-1 px-4 py-3 font-normal text-xs  border rounded hover:bg-white hover:text-darkblue focus:bg-darkblue focus:text-white cursor-pointer': link.url !== null,
                    'mr-1 mb-1 px-4 py-3 bg-darkblue text-primary font-normal': link.active,
                }" class="h-[42px] w-[60px] rounded  font-bold text-xs items-center justify-center flex "
                    :href="link.url" v-html="link.label" />

            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

const props = defineProps<{
    links: {
        url: string;
        label: string;
        active: boolean;
    }[];
}>();
</script>