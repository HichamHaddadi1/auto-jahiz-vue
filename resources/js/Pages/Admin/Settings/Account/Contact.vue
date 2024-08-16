<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/shadcn/Components/ui/card'
import { MessagesSquare } from 'lucide-vue-next';
import Input from '@/shadcn/Components/ui/input/Input.vue';
import Label from '@/shadcn/Components/ui/label/Label.vue';
import Button from '@/shadcn/Components/ui/button/Button.vue';
import { useToast } from 'vue-toast-notification';


const props = defineProps<{
    account: {
        email: string;
    };
}>();

const form = useForm({
    email: props.account && props.account.email ? props.account.email : '',
});

const toast = useToast();


const save = () => {
    form.post('/settings/account', {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Contact enregistré avec succès');
        },
    });
}
</script>

<template>

    <Head title="Contact" />

    <div class="flex items-center justify-center h-1/2">
        <Card class="w-full">
            <div class="flex items-center justify-start py-4 px-4 gap-2">
                <MessagesSquare class="w-6 h-6 text-gray-400" />
                <CardTitle class="text-lg font-medium text-gray-900">
                    Contact
                </CardTitle>

            </div>
            <CardDescription class="flex flex-col  py-4 px-4 gap-6">
                <div class="flex flex-col gap-2 relative">
                    <Label for="email"
                        class="absolute mt-1 left-2 top-0 px-1 text-gray-500 transition-all duration-200 transform -translate-y-3 scale-75 origin-[0] bg-background peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">Email</Label>
                    <Input type="email" id="email" v-model="form.email"
                        class="w-full appearance-none bg-background border focus-visible:ring-0 focus-visible:ring-transparent " />
                </div>
                <Button class="w-fit self-end border" variant="default" @click="save">
                    Enregistrer
                </Button>
            </CardDescription>
        </Card>
    </div>
</template>
