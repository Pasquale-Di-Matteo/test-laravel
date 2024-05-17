<script setup>
import { ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps(["userToken"]);
import axios from "axios";
const Breweries = ref([]);
const pageSize = 5;
const currentPage = ref(1);

const fetchBreweries = async () => {
    await axios
        .get("/api/breweries", {
            headers: {
                Authorization: `Bearer ${props.userToken}`,
            },
        })
        .then((response) => {
            Breweries.value = response.data;
        })
        .catch((error) => {
            console.error("Error fetching breweries:", error);
        });
};

const paginatedBreweries = computed(() => {
    const startIndex = (currentPage.value - 1) * pageSize;
    return Breweries.value.slice(startIndex, startIndex + pageSize);
});

const totalPages = computed(() => Math.ceil(Breweries.value.length / pageSize));

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                    <div class="p-6 text-gray-900">
                        Your token: {{ props.userToken }}
                    </div>
                    <button @click="fetchBreweries" class="p-3 m-2 bg-blue-500 text-white rounded-md">
                        Fetch Breweries
                    </button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-4">
            <div v-for="Brewerie in paginatedBreweries"
                class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                <div class="p-6">
                    <h5
                        class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                        {{ Brewerie.name }}
                    </h5>
                    <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        {{ Brewerie.city }}
                    </p>
                    <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        {{ Brewerie.postal_code }}
                    </p>
                    <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        {{ Brewerie.state }}
                    </p>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-4" v-if="Breweries.length">
            <button @click="prevPage" :disabled="currentPage === 1"
                class="px-4 py-2 mr-2 bg-gray-300 text-gray-700 rounded-md">
                Previous
            </button>
            <button @click="nextPage" :disabled="currentPage === totalPages"
                class="px-4 py-2 ml-2 bg-gray-300 text-gray-700 rounded-md">
                Next
            </button>
        </div>
    </AuthenticatedLayout>
</template>
