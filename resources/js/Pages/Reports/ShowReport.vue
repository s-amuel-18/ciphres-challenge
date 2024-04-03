<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { format } from 'date-fns';

const props = defineProps({
    saleReport: { type: Object },
    totalRevenue: { type: Object },
    sales: { type: [Array] }
});

const {
    id,
    title,
    begin_date,
    end_date,
    user,

} = props.saleReport

const {
    total_price: total_revenue,
    total_cost: total_cost,
    total_taxes: total_tax,
} = props.totalRevenue
// console.log(props.totalRevenue);

</script>

<template>
    <AuthenticatedLayout>

        <Head title="Report" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Report N° {{ id }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <div class="mt-4"><b>title:</b> {{ title }}</div>
                    <div class="mt-4"><b>begin date:</b> {{ begin_date }}</div>
                    <div class="mt-4"><b>end date:</b> {{ end_date }}</div>
                    <div class="mt-4"><b>user: </b> {{ user.name }}</div>
                    <div class="mt-4"><b>total revenue:</b> {{ total_revenue }}</div>
                    <div class="mt-4"><b>total cost:</b> {{ total_cost }}</div>
                    <div class="mt-4"><b>total tax:</b> {{ total_tax }}</div>

                    <div class="position-relative mt-4">
                        <table class="border-collapse border border-slate-500 w-full">
                            <thead>
                                <tr>
                                    <th class="border border-slate-600">date</th>
                                    <th class="border border-slate-600">user name</th>
                                    <th class="border border-slate-600">product</th>
                                    <th class="border border-slate-600">items</th>
                                    <th class="border border-slate-600">pay amount</th>
                                    <th class="border border-slate-600">On currency</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="sale in sales">
                                    <tr>
                                        <td class="border border-slate-700">{{ format(sale.created_at, "dd-MM-yyyy") }}
                                        </td>
                                        <td class="border border-slate-700">{{ sale.user.name }}</td>
                                        <td class="border border-slate-700">{{ sale?.product?.title || "" }}</td>
                                        <td class="border border-slate-700">{{ sale.quantity }}</td>
                                        <td class="border border-slate-700">{{ sale.price }} USD</td>
                                        <td class="border border-slate-700">{{ sale.currency_price }} {{
                sale.currency_code }}</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
