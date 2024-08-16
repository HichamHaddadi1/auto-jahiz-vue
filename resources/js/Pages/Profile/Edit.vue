<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/shadcn/Components/ui/tabs'
defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>

    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-9">
            <Tabs default-value="account" class="border p-4 rounded">
                <TabsList class="grid w-full grid-cols-3">
                    <TabsTrigger value="account">
                        Account
                    </TabsTrigger>
                    <TabsTrigger value="password">
                        Password
                    </TabsTrigger>
                    <TabsTrigger value="delete">
                        Delete Account
                    </TabsTrigger>
                </TabsList>
                <TabsContent value="account">
                    <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class=" " />
                </TabsContent>
                <TabsContent value="password">
                    <UpdatePasswordForm class=" " />
                </TabsContent>
                <TabsContent value="delete">
                    <DeleteUserForm class=" " />
                </TabsContent>
            </Tabs>

        </div>


    </AuthenticatedLayout>
</template>
