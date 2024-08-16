<script setup lang="ts">
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { Card, CardDescription, CardTitle } from "@/shadcn/Components/ui/card";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/shadcn/Components/ui/select";
import { Cog } from "lucide-vue-next";
import Input from "@/shadcn/Components/ui/input/Input.vue";
import Label from "@/shadcn/Components/ui/label/Label.vue";
import Button from "@/shadcn/Components/ui/button/Button.vue";
import { useToast } from "vue-toast-notification";
import { ref, onMounted } from "vue";
import axios from "axios";

const appurl = ref((usePage().props.url as { appurl: string }).appurl).value;

const props = defineProps<{
    account: {
        email: string;
        last_bill_number: string;
        tva: number;
        visite_alert: number;
        insurances_alert: number;
        permissions_alert: number;
        oil_change_alert: number;
        currency_id: string;
        language_id: string;
        notification_language_id: string;
    };
}>();

const form = useForm({
    last_bill_number: props.account ? props.account.last_bill_number : "",
    tva: props.account ? props.account.tva : 0,
    visite_alert: props.account ? props.account.tva : 0,
    insurances_alert: props.account ? props.account.insurances_alert : 0,
    permissions_alert: props.account ? props.account.permissions_alert : 0,
    oil_change_alert: props.account ? props.account.oil_change_alert : 0,
    currency_id: props.account ? props.account.currency_id : '',
    language_id: props.account ? props.account.language_id : '',
    notification_language_id: props.account ? props.account.notification_language_id : '',
});

interface Currency {
    id: string;
    name: string;
}
interface Language {
    id: string;
    name: string;
}

const toast = useToast();

const currencies = ref<Currency[]>([]);
const languages = ref<Language[]>([]);


const save = () => {
    form.post(appurl + "/settings/account", {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Contact enregistré avec succès");
        },
    });
};

const fetchCurrencies = () => {
    axios.get(appurl + "/api/fetch-currencies").then((response) => {
        currencies.value = response.data;
    }).catch((error) => {
        console.log(error);
    });
};

const fetchLanguages = () => {
    axios.get(appurl + "/api/fetch-languages").then((response) => {
        languages.value = response.data;
    }).catch((error) => {
        console.log(error);
    });
};

onMounted(() => {
    fetchCurrencies();
    fetchLanguages();

});
</script>

<template>

    <Head title="Configuration" />
    <div class="flex items-center justify-center h-1/2">
        <Card class="w-full">
            <div class="flex items-center justify-start py-4 px-4 gap-2">
                <Cog class="w-6 h-6 text-gray-400" />
                <CardTitle class="text-lg font-medium text-gray-900"> Configuration </CardTitle>
            </div>
            <CardDescription class="flex flex-col py-4 px-4 gap-6">
                <!-- First row -->
                <div class="grid lg:grid-cols-3 gap-4">
                    <div class="relative">
                        <Input type="text" id="last_bill_number" placeholder="" v-model="form.last_bill_number"
                            class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent peer" />
                        <Label for="last_bill_number"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            N° dernière facture
                        </Label>
                    </div>
                    <div class="relative">
                        <Input type="number" id="tva" placeholder="" min="0" step="0.1" v-model="form.tva"
                            class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent peer" />
                        <Label for="tva"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Taux de TVA :
                        </Label>
                    </div>
                    <div class="relative">
                        <Input type="number" id="visite-alert" placeholder="" min="0" v-model="form.visite_alert"
                            class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent peer" />
                        <Label for="visite-alert"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Alerte Visite :
                        </Label>
                    </div>
                </div>
                <!-- Second row -->
                <div class="grid lg:grid-cols-3 gap-4">
                    <div class="relative">
                        <Input type="text" id="last_bill_number" placeholder="" v-model="form.insurances_alert"
                            class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent peer" />
                        <Label for="last_bill_number"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Alerte assurance :
                        </Label>
                    </div>
                    <div class="relative">
                        <Input type="number" id="tva" placeholder="" min="0" step="0.1" v-model="form.permissions_alert"
                            class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent peer" />
                        <Label for="tva"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Alerte autorisation :
                        </Label>
                    </div>
                    <div class="relative">
                        <Input type="number" id="visite-alert" placeholder="" min="0" v-model="form.oil_change_alert"
                            class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent peer" />
                        <Label for="visite-alert"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Alerte vidange :
                        </Label>
                    </div>
                </div>
                <!-- Third row -->
                <div class="grid lg:grid-cols-3 gap-4">
                    <div class="relative">
                        <Select v-model="form.currency_id">
                            <SelectTrigger>
                                <SelectValue />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem v-for="currency in currencies" :value="currency.id">
                                        {{ currency.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <Label for="visite-alert"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Sélectionnez une devise
                        </Label>
                    </div>
                    <div class="relative">
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
                        <Label for="visite-alert"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Sélectionnez une langue
                        </Label>
                    </div>
                    <div class="relative">
                        <Select v-model="form.notification_language_id">
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
                        <Label for="visite-alert"
                            class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Sélectionnez une langue de notification </Label>
                    </div>
                </div>


                <Button class="w-fit self-end border" variant="default" @click="save">
                    Enregistrer
                </Button>
            </CardDescription>
        </Card>
    </div>
</template>

<style>
input:focus+label,
input:not(:placeholder-shown)+label {
    transform: scale(0.75) translateY(-0.75rem) !important;
    color: #6b7280 !important;
}
</style>
