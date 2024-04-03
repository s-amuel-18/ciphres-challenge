<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { format } from 'date-fns';

const form = useForm({
    title: 'Titulo del reporte',
    begin_date: format(new Date(), "yyyy-MM-dd"),
    end_date: format(new Date(), "yyyy-MM-dd"),
});

const submit = () => {
    form.post(route('product.report.store'), {
        onFinish: () => form.reset(
            'title',
            'begin_date',
            'end_date',
        ),
    });
};
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Create" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit" class="grid grid-cols-4 gap-3">
                        <div>
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" type="text" class=" block w-full" v-model="form.title" required
                                autofocus autocomplete="Product title" />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div>
                            <InputLabel for="begin_date" value="Begin Date" />
                            <TextInput id="begin_date" type="date" class=" block w-full" v-model="form.begin_date"
                                required autocomplete="" />
                            <InputError class="mt-2" :message="form.errors.begin_date" />
                        </div>
                        <div>
                            <InputLabel for="end_date" value="End Date" />
                            <TextInput id="end_date" type="date" class=" block w-full" v-model="form.end_date" required
                                autocomplete="" />
                            <InputError class="mt-2" :message="form.errors.end_date" />
                        </div>
                        <div class="flex items-end">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                create product
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
