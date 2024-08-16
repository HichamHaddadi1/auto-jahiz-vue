<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/shadcn/Components/ui/card'

import { LucideLayoutDashboard } from 'lucide-vue-next';

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex items-center justify-center h-1/2">
            <Card class="lg:w-1/2 ">
                <CardHeader class="flex items-center justify-center text-center">
                    <LucideLayoutDashboard class="w-16 h-16 text-gray-400" />
                    <CardTitle class="text-lg font-medium text-gray-900">Dashboard</CardTitle>

                    <CardDescription class="mt-1 text-sm text-gray-600">
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                    </CardDescription>

                </CardHeader>
            </Card>
        </div>
    </AuthenticatedLayout>
</template>
