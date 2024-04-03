<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryLink from '@/Components/PrimaryLink.vue';

defineProps({
    reports: {
        type: [Array],
    }
});
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Reports" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reports</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <PrimaryLink :href="route('product.report.create')">
                        New report
                    </PrimaryLink>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <table class="border-collapse border border-slate-500 w-full">
                        <thead>
                            <tr>
                                <th class="border border-slate-600">id</th>
                                <th class="border border-slate-600">report</th>
                                <th class="border border-slate-600">begin date</th>
                                <th class="border border-slate-600">end date</th>
                                <th class="border border-slate-600"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="item in reports.data">
                                <tr>
                                    <td class="border border-slate-700">{{ item.id }}</td>
                                    <td class="border border-slate-700">{{ item.title }}</td>
                                    <td class="border border-slate-700">{{ item.begin_date }}</td>
                                    <td class="border border-slate-700">{{ item.end_date }}</td>
                                    <td class="border border-slate-700">
                                        <Link :href="route('product.report.show', { saleReport: item.id })"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        See report
                                        </Link>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <ul class="flex gap-2 mt-3 justify-end">
                        <li v-if="reports.prev_page_url">
                            <a @click.prevent="$inertia.visit(reports.prev_page_url)" href="#">Prev</a>
                        </li>
                        <li v-if="reports.next_page_url">
                            <a @click.prevent="$inertia.visit(reports.next_page_url)" href="#">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
