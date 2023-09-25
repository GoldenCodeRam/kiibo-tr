<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-stone-500">Dashboard</Link>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center select-none pointer-events-none">
                <img src="img/logo.svg" class="w-48"/>
            </div>

            <div class="mt-16">
                <h1 class="text-center mb-8">
                Sistema de gestión de notas importantísimas.
                </h1>

                <div class="flex gap-8 justify-center">
                    <Link :href="route('login')">
                        <PrimaryButton class="ml-4">
                            Ingresar
                        </PrimaryButton>
                    </Link>
                    <Link :href="route('register')">
                        <PrimaryButton class="ml-4">
                            Registrarse
                        </PrimaryButton>
                    </Link>
                </div>
            </div>

            <div class="flex justify-center mt-16 px-6 items-center">
                <div class="text-center text-sm text-gray-500">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>
