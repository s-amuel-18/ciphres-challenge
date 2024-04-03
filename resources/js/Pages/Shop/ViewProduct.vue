<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import { ref, } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    product: { type: Object },
    currencies: { type: [Array] },
});


const {
    id,
    title,
    image,
    price,
    cost,
    tax,
    description, } = props.product


const form = useForm({
    quantity: 1,
    currency: 1 /* USD */
});
// console.log(form.quantity);
const findCurrency = () => props.currencies.find(c => c.id == form.currency);
const getPrice = () => ((findCurrency().to_change * price) * form.quantity).toFixed(2);

const priceFormat = ref({
    price: getPrice(),
    currency: findCurrency()
})

const isBuying = ref(false)
const msg = ref(null)




const closeModal = () => {

}

const submit = () => {
    resetMsg()
    form.post(route("product.sale", { product: id }), {
        preserveScroll: true,
        onSuccess: () => buySuccessfuly(),
    })
}

const resetMsg = () => msg.value = null

const buySuccessfuly = () => {

    msg.value = "Purchase made successfully!!";
}

const onInputsChange = () => {
    priceFormat.value = {
        price: getPrice(),
        currency: findCurrency()
    }

}


</script>

<template>
    <AuthenticatedLayout>

        <Modal :show="isBuying" @close="closeModal">
            <div class="p-6">
                <h2>{{ title }}</h2>
            </div>
        </Modal>

        <Head title="Edit" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ title }}</h2>
        </template>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="msg" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
                    {{ msg }}
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <div>
                        <h1>{{ title }}</h1>
                    </div>
                    <div class="mt-4 grid grid-cols-2">
                        <div class="mt-4">
                            Price
                            <p>{{ price }}</p>
                        </div>
                        <div class="mt-4">
                            Tax
                            <p>{{ tax }}</p>
                        </div>
                        <div class="mt-4">
                            Cost
                            <p>{{ cost }}</p>
                        </div>
                    </div>
                    <div class="position-relative">
                        <img :src="image ?? '/images/default-product.png'"
                            class=" h-20 w-20 rounded-full border-2 border-white" />
                    </div>
                    <div class="mt-4">
                        Description
                        <p>{{ description }}</p>

                    </div>

                    <form @submit.prevent="submit" class="mt-4">
                        <h3 class="text-xl mb-3">Buy</h3>

                        <div class="grid grid-cols-4 gap-2">

                            <div class=" ">
                                <TextInput v-on:change="onInputsChange" v-model="form.quantity" class="w-[100%]"
                                    id="quantity" type="number" placeholder="Quantity" min="1" required />
                            </div>
                            <div class="">
                                <select v-on:change="onInputsChange" v-model="form.currency"
                                    class="w-[100%] border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <!-- <option value="1">dsadsa</option> -->
                                    <option :selected="currency.id == form.currency"
                                        v-for="(currency, index) in currencies" :key="index" :value="currency.id">
                                        {{ currency.name }} ({{ currency.code }})
                                    </option>

                                </select>
                            </div>
                            <div class="flex items-center">
                                {{ priceFormat.price }} {{ priceFormat.currency.code }}
                            </div>
                            <div class="">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Buy Product
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
