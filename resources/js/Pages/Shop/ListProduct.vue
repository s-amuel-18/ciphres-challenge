<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import { computed } from 'vue';


const page = usePage()

// NOTE: Esto se puedo mejorar
const userIsAdmin = page.props.auth.user.fk_role_id == 1

const props = defineProps({
    products: {
        type: [Array],
    }
});

const form = useForm({});

const handleDelete = (productId) => {
    console.log({ productId });
    const isConfirmed = confirm("Are you sure to remove this product?")

    if (!isConfirmed) return;
    form.delete(route("product.delete", { product: productId }), { preserveScroll: true, });

}



</script>

<template>
    <AuthenticatedLayout>

        <Head title="Dashboard" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product list</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <PrimaryLink v-if="userIsAdmin" :href="route('product.create')">
                        New product
                    </PrimaryLink>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 mt-2">
                    <table class="border-collapse border border-slate-500 w-full">
                        <thead>
                            <tr>
                                <th class="border border-slate-600">product</th>
                                <th class="border border-slate-600">title</th>
                                <th class="border border-slate-600">price</th>
                                <th class="border border-slate-600"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="item in products.data">
                                <tr class="text-center">
                                    <td class="position-relative">
                                        <img :src="item.image ?? '/images/default-product.jpg'"
                                            class="h-10 w-10 rounded-full border-2 border-white m-auto" />
                                    </td>
                                    <td class="border border-slate-700">{{ item.title }}</td>
                                    <td class="border border-slate-700">{{ item.price }}</td>
                                    <td class="border border-slate-700">
                                        <Link :href="route('product.show', { product: item.id })"
                                            class="block underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        See product
                                        </Link>
                                        <Link v-if="userIsAdmin" :href="route('product.edit', { product: item.id })"
                                            class="block underline text-sm text-green-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Update product
                                        </Link>
                                        <p v-if="userIsAdmin" @click="handleDelete(item.id)"
                                            class="cursor-pointer block underline text-sm text-red-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Delete product
                                        </p>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <ul class="flex gap-2 mt-3 justify-end">
                        <li v-if="products.prev_page_url">
                            <a @click.prevent="$inertia.visit(products.prev_page_url)" href="#">Prev</a>
                        </li>
                        <li v-if="products.next_page_url">
                            <a @click.prevent="$inertia.visit(products.next_page_url)" href="#">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
