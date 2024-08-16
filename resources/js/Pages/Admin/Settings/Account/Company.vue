<script setup lang="ts">
import { ref } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/shadcn/Components/ui/card'

import { Building } from 'lucide-vue-next';
import Input from '@/shadcn/Components/ui/input/Input.vue';
import Label from '@/shadcn/Components/ui/label/Label.vue';
import Button from '@/shadcn/Components/ui/button/Button.vue';
import { useToast } from 'vue-toast-notification';
import Textarea from '@/shadcn/Components/ui/textarea/Textarea.vue';

const appurl = ref((usePage().props.url as { appurl: string }).appurl).value;


const props = defineProps<{
    account: {
        social_reason: string;
        footers: string;
    };
}>();

const form = useForm({
    social_reason: props.account && props.account.social_reason ? props.account.social_reason : '',
    footers: props.account && props.account.footers ? props.account.footers : '',
});

const toast = useToast();

const save = () => {
    form.post(appurl + '/settings/account', {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Entreprise enregistrée avec succès');
        },
    });
}

</script>

<template>

    <Head title="Entreprise" />
    <div class="flex items-center justify-center h-1/2">
        <Card class="w-full">
            <div class="flex items-center justify-start py-4 px-4 gap-2">
                <Building class="w-6 h-6 text-gray-400" />
                <CardTitle class="text-lg font-medium text-gray-900">
                    Entreprise
                </CardTitle>

            </div>
            <CardDescription class="flex flex-col  py-4 px-4 gap-6">
                <div class="flex flex-col gap-2 relative">
                    <Label for="social-reason"
                        class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">Raison
                        sociale</Label>
                    <Input type="social-reason" id="social-reason" v-model="form.social_reason"
                        class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent " />
                </div>
                <div class="flex flex-col gap-2 relative">
                    <Label for="footer"
                        class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">Info</Label>
                    <Textarea placeholder="" id="footer" v-model="form.footers"
                        class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent" />

                </div>
                <Button class="w-fit self-end border" variant="default" @click="save">
                    Enregistrer
                </Button>
            </CardDescription>
        </Card>
    </div>
</template>
