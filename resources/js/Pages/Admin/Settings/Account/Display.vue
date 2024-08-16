<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import {
    Card,
    CardDescription,
    CardTitle,
} from '@/shadcn/Components/ui/card'

import { MonitorCog } from 'lucide-vue-next';
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/shadcn/Components/ui/popover'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/shadcn/Components/ui/select";
import { Button } from '@/shadcn/Components/ui/button'
import { Label } from '@/shadcn/Components/ui/label'
import { ref, onMounted } from 'vue';
import { useToast } from 'vue-toast-notification';
import axios from 'axios';
import Input from '@/shadcn/Components/ui/input/Input.vue';


const props = defineProps<{
    account: {
        theme: string;
    };
}>();

interface Language {
    id: string;
    name: string;
}
const appurl = ref((usePage().props.url as { appurl: string }).appurl).value;

const toast = useToast();

const colors = [
    {
        id: 1,
        name: "Blue",
        class: "theme-blue",
        displayColor: "#3B82F6",
    },
    {
        id: 3,
        name: "Green",
        class: "theme-green",
        displayColor: "#10B981",
    },
    {
        id: 4,
        name: "Orange",
        class: "theme-orange",
        displayColor: "#F59E0B",
    },
    {
        id: 5,
        name: "Rose",
        class: "theme-rose",
        displayColor: "#F472B6",
    },
];

const form = useForm({
    theme: '',
    // language_id: '',
    logo: new File([], ''),
    favicon: new File([], ''),
});
let currentTheme = ref(localStorage.getItem("theme") || "theme-blue").value;
const languages = ref<Language[]>([]);

const setTheme = (theme: string) => {
    document.documentElement.className = theme;
    localStorage.setItem("theme", theme);
    currentTheme = theme;
    form.theme = theme;
    form.post(appurl + "/settings/account", {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Théme modifié avec succès");
        },
    });
}

// const fetchLanguages = () => {
//     axios.get(appurl + "/api/fetch-languages").then((response) => {
//         languages.value = response.data;
//     }).catch((error) => {
//         console.log(error);
//     });
// };

const handleLogoUpload = (file: File | null) => handleFileUpload(file, 'logo');
const handleFaviconUpload = (file: File | null) => handleFileUpload(file, 'favicon');


const handleFileUpload = (file: File | null, type: 'logo' | 'favicon') => {
    if (file) {
        form[type] = file;
        form.post(`${appurl}/settings/account`, {
            preserveScroll: true,
            onSuccess: () => {
                const message = type === 'logo'
                    ? "Logo modifié avec succès"
                    : "Favicone modifié avec succès";
                toast.success(message);
            },
        });
    }
}

onMounted(() => {
    // fetchLanguages();
    form.theme = currentTheme;
});
</script>

<template>

    <Head title="Affichage" />

    <div class="flex items-center justify-center h-1/2">
        <Card class="w-full">
            <div class="flex items-center justify-start py-4 px-4 gap-2">
                <MonitorCog class="w-6 h-6 text-gray-400" />
                <CardTitle class="text-lg font-medium text-gray-900"> Affichage </CardTitle>
            </div>

            <CardDescription class="flex flex-col py-4 px-4 gap-6  ">
                <div class="flex items-center justify-between py-2">
                    <Label>
                        Théme de l'application
                    </Label>
                    <div class="flex items-center gap-4">
                        <span :class="account.theme" class="!border h-6 w-6 rounded-full bg-primary"></span>
                        <Popover>
                            <PopoverTrigger>

                                <Button variant="default" class="w-[324px]">
                                    Sélectionner une couleur
                                </Button>
                            </PopoverTrigger>
                            <PopoverContent class="" side="left">
                                <div class="flex items-center justify-center gap-4">

                                    <template v-for="color in colors">

                                        <Button class="w-8 h-8 rounded-full" :class="[
                                            color.class,
                                            account.theme === color.class
                                                ? `ring-2 ring-offset-2 ring-primary`
                                                : '',
                                        ]" @click="setTheme(color.class)">
                                        </Button>

                                    </template>
                                </div>

                            </PopoverContent>
                        </Popover>
                    </div>
                </div>
                <!-- <div class="flex items-center justify-between py-2">
                    <Label class="">
                        Langue par défaut de l'application
                    </Label>
                    <div class="flex items-center gap-4 w-[324px]">
                        <Select v-model="form.language_id">
                            <SelectTrigger>
                                <SelectValue />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem v-for="language in languages" :value="language.id">
                                        {{ language.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>
                </div> -->
                <div class="flex items-center justify-between py-2">
                    <Label class="">
                        Logo de l'application
                    </Label>
                    <div class="flex items-center gap-4">
                        <Input type="file" class="bg-primary-foreground text-muted-foreground"
                            @change="handleLogoUpload($event.target.files?.[0])" />
                    </div>
                </div>
                <div class="flex items-center justify-between py-2">
                    <Label class="">
                        Favicone de l'application
                    </Label>
                    <div class="flex items-center gap-4">
                        <Input type="file" class="bg-primary-foreground text-muted-foreground"
                            @change="handleFaviconUpload($event.target.files?.[0])" />

                    </div>
                </div>
            </CardDescription>

        </Card>
    </div>
</template>
