<script setup lang="ts">
import { ref } from 'vue';
import VehicleType from '@/types/VehicleType';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/shadcn/Components/ui/card'
import {
    Menubar,
    MenubarContent,
    MenubarItem,
    MenubarMenu,
    MenubarTrigger,
} from '@/shadcn/Components/ui/menubar'

import { EllipsisVertical } from 'lucide-vue-next';
import Pagination from '@/Components/Pagination.vue';
import EmptyState from '@/Components/EmptyState.vue';
const props = defineProps<{
    vehicles: VehicleType[];
}>();

</script>
<template>
    <div class="flex flex-col gap-2 divide-y">
        <template v-for="vehicle in vehicles" :key="vehicle" v-if="vehicles && vehicles.length > 0">
            <Card>
                <div class="flex items-center justify-between">
                    <CardHeader class=" ">
                        <CardTitle class="text-base">{{ vehicle.name }}</CardTitle>
                        <CardDescription class="text-sm">{{ vehicle.description }}</CardDescription>
                    </CardHeader>
                    <Menubar class="border-none">
                        <MenubarMenu>
                            <MenubarTrigger>
                                <EllipsisVertical class="h-5 w-5 cursor-pointer" />
                            </MenubarTrigger>
                            <MenubarContent>
                                <MenubarItem>Modifier</MenubarItem>
                                <MenubarItem>Supprimer</MenubarItem>
                            </MenubarContent>
                        </MenubarMenu>
                    </Menubar>
                </div>
            </Card>
        </template>
        <template v-else>
            <EmptyState message="Aucun véhicule trouvé" />
        </template>
        <!-- <div class="flex items-center justify-center py-4">
            <Pagination :links="vehicles.links" v-if="vehicles && vehicles.links" />
        </div> -->
    </div>
</template>