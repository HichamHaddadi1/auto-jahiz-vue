<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/shadcn/Components/ui/tabs'
import Company from './Company.vue';
import Contact from './Contact.vue';
import Configurations from './Configuration.vue';
import Affichage from './Display.vue';
defineProps({
    account: Object,
});
</script>

<template>

    <Head title="Compte" />

    <AuthenticatedLayout>
        <div class="py-[37px]">
            <Tabs default-value="entreprise" class="border p-4 rounded">
                <TabsList class="grid lg:grid-cols-4 w-full grid-cols-1 h-fit">
                    <TabsTrigger value="entreprise">
                        Entreprise
                    </TabsTrigger>
                    <TabsTrigger value="contact">
                        Contact
                    </TabsTrigger>
                    <TabsTrigger value="configurations">
                        Configurations
                    </TabsTrigger>
                    <TabsTrigger value="affichage">
                        Affichage
                    </TabsTrigger>
                </TabsList>
                <TabsContent value="entreprise">
                    <Company :account="account" />
                </TabsContent>
                <TabsContent value="contact">
                    <Contact :account="account" />
                </TabsContent>
                <TabsContent value="configurations">
                    <Configurations :account="account" />
                </TabsContent>
                <TabsContent value="affichage">
                    <Affichage :account="account" />
                </TabsContent>
            </Tabs>

        </div>
    </AuthenticatedLayout>
</template>
