<template>
    <Alert class="flex flex-col items-center justify-center">
        <AlertTitle class="flex flex-col items-center justify-center gap-4">
            <CircleAlert class="w-12 h-12 text-destructive" />
            <p>
                Attention!
            </p>
        </AlertTitle>
        <AlertDescription>
            {{ props.message }}
        </AlertDescription>
    </Alert>
</template>

<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/shadcn/Components/ui/alert'
import { CircleAlert } from 'lucide-vue-next';

const props = defineProps<{
    message: string;
}>();
</script>