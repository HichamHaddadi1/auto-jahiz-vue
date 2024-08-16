<script setup lang="ts">
import Vehicle from '@/types/VehicleType';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted, watch, computed, reactive } from 'vue'
import {
    Card,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/shadcn/Components/ui/card'
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
} from '@/shadcn/Components/ui/breadcrumb'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/shadcn/Components/ui/dropdown-menu'
import { Car, ChevronDown, Plus, Search } from 'lucide-vue-next';
import Button from '@/shadcn/Components/ui/button/Button.vue';
import BreadcrumbSeparator from '@/shadcn/Components/ui/breadcrumb/BreadcrumbSeparator.vue';
import Input from '@/shadcn/Components/ui/input/Input.vue';
import VehicleList from '@/Pages/Admin/Vehicles/VehicleList.vue';
import axios from 'axios';
import Modal from '@/Components/Modal.vue';
import VehicleForm from '@/Pages/Admin/Vehicles/VehicleForm.vue';
const appurl = ref((usePage().props.url as { appurl: string }).appurl).value;

const openAddVehicleModal = ref(false);
const vehicles = ref<Vehicle[]>([]);

const fetchVehicles = () => {
    axios.get(appurl + '/api/fetch-vehicles')
        .then((response) => {
            vehicles.value = response.data;
        })
        .catch((error) => {
            console.error(error);
        });
}

onMounted(() => {
    fetchVehicles();
});

</script>


<template>

    <Head title="Vehicles" />

    <AuthenticatedLayout>
        <div class="flex items-center justify-center h-1/2" v-if="vehicles && vehicles.length === 0">

            <Card class="lg:w-1/2 ">
                <CardHeader class="flex items-center justify-center text-center gap-2">
                    <Car class="w-16 h-16 text-gray-400" />
                    <CardTitle class="text-lg font-medium text-gray-900">Véhicules</CardTitle>

                    <CardDescription class="mt-1 text-sm text-gray-600">
                        Liste des véhicules
                    </CardDescription>

                </CardHeader>
                <CardFooter>
                    <Button class="w-full" variant="default" @click="openAddVehicleModal = true">
                        <Plus class="w-4 h-4 mr-2" />
                        Ajouter une véhicule
                    </Button>
                </CardFooter>
            </Card>
        </div>
        <div v-else class="pt-6 px-8 border h-screen rounded mt-9">
            <Breadcrumb>
                <BreadcrumbList>
                    <BreadcrumbItem>
                        <BreadcrumbLink>
                            <Link :href="appurl + '/dashboard'">
                            Tableau de bord
                            </Link>
                        </BreadcrumbLink>
                    </BreadcrumbItem>
                    <BreadcrumbSeparator />
                    <BreadcrumbItem>
                        <BreadcrumbPage class="font-semibold text-gray-900">Véhicules</BreadcrumbPage>
                    </BreadcrumbItem>
                </BreadcrumbList>
            </Breadcrumb>
            <div class="flex flex-col w-full pt-4 gap-4">
                <div class="flex items-center justify-between">
                    <h4 class="text-lg font-semibold text-gray-900">Véhicules</h4>
                    <Button class="ml-4" variant="default">
                        <Plus class="w-4 h-4 mr-2" />
                        Ajouter une véhicule
                    </Button>
                </div>
                <div class="w-full flex justify-between items-center gap-4">
                    <div class="relative w-full">
                        <Search class="absolute left-2.5 top-3 h-4 w-4 text-muted-foreground" />
                        <Input type="search" placeholder="Rechercher des véhicules..."
                            class="w-full appearance-none bg-background pl-8 border focus-visible:ring-0 focus-visible:ring-transparent" />
                    </div>
                    <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                            <Button variant="outline" class="ml-auto">
                                Filter
                                <ChevronDown class="ml-2 h-4 w-4" />
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                            <DropdownMenuItem>
                                Plus récent
                            </DropdownMenuItem>
                            <DropdownMenuItem>
                                Ordre alphabétique
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </div>
                <VehicleList :vehicles="vehicles" />

            </div>
        </div>
        <Modal :show="openAddVehicleModal" @close="openAddVehicleModal = false" :maxWidth="'full'">
            <VehicleForm />
        </Modal>
    </AuthenticatedLayout>
</template>