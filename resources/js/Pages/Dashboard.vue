<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import TextArea from '@/Components/TextArea.vue';
import Dialog from '@/Components/Dialog.vue';

import { TrashIcon, InboxIcon, PencilIcon } from "@heroicons/vue/24/solid";

import { useForm } from "@inertiajs/vue3";
import { findLogs, storeLog, deleteLog, findLog, patchLog } from "@/Service/LogService";
import { ref } from "vue";

const postForm = useForm({
    _method: 'POST',
    log: null,
});

const patchForm = useForm({
    _method: 'PATCH',
    log: null,
});

const logs = ref([]);

const isDeleteLogDialogOpen = ref(false);
const isUpdateLogDialogOpen = ref(false);

const selectedLogToDelete = ref(null);
const selectedLogToUpdate = ref(null);

function saveLog() {
    storeLog({
        log: postForm.log,
    }).then(() => {
        loadLogs();
    });
}

function loadLogs() {
    findLogs().then(result => {
        logs.value = result;
    });
}

function openDeleteLogDialog(log) {
    selectedLogToDelete.value = log;
    isDeleteLogDialogOpen.value = true;
}

async function openUpdateLogDialog(log) {
    selectedLogToUpdate.value = await findLog(log);
    isUpdateLogDialogOpen.value = true;
}

async function deleteSelectedLog() {
    await deleteLog(selectedLogToDelete.value);
    loadLogs();
    isDeleteLogDialogOpen.value = false;
}

async function patchSelectedLog() {
    await patchLog(selectedLogToUpdate.value);
    loadLogs();
    isUpdateLogDialogOpen.value = false;
}
loadLogs();
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12 flex-1 flex flex-col container mx-auto">
            <div class="sm:px-6 lg:px-8 flex flex-col flex-1">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex-1 flex flex-col">
                    <div class="grid grid-cols-12 md:flex-1">
                        <div class="col-span-12 md:col-span-4 px-8 py-4">
                            <h1 class="text-xl text-center">
                                Crear nueva tarea
                                <!-- New task -->
                                <div class="col-span-6 sm:col-span-4 py-4">
                                    <InputLabel for="log" value="Tarea" />
                                    <TextArea id="log" v-model="postForm.log" type="text" class="mt-1 block w-full max-h-60"
                                        required />
                                    <InputError :message="postForm.errors.log" class="mt-2" />
                                </div>
                                <PrimaryButton @click="saveLog">Guardar</PrimaryButton>
                            </h1>
                        </div>
                        <div class="col-span-12 md:col-span-8 bg-gray-50 border-l-gray-200 md:border-l px-8 py-4 overflow-auto max-h-screen">
                            <div class="flex flex-col gap-4 h-full">
                                <div v-if="logs.length == 0" class="h-full flex justify-center">
                                    <div class="my-auto text-gray-400">
                                        <InboxIcon class="h-16 w-16 mx-auto" />
                                        <p class="mx-auto text-xl">
                                            Sin tareas
                                        </p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 bg-white rounded-md shadow-sm px-4 py-2"
                                    v-for="log, key in logs" :key="key">
                                    <div class="col-span-11">
                                        <h1>Código de tarea: {{ log.id }}</h1>
                                        <p>
                                            {{ log.content }}
                                        </p>
                                    </div>
                                    <div class="col-span-1 flex flex-col gap-2 justify-center items-center">
                                        <TertiaryButton @click="openDeleteLogDialog(log)"
                                            class="bg-red-100 hover:bg-red-200 border-red-300 focus:ring-red-400">
                                            <TrashIcon class="h-4 w-4 text-red-300" />
                                        </TertiaryButton>
                                        <TertiaryButton @click="openUpdateLogDialog(log)"
                                            class="bg-gray-100 hover:bg-gray-200 border-gray-300 focus:ring-gray-400">
                                            <PencilIcon class="h-4 w-4 text-gray-300" />
                                        </TertiaryButton>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Dialog :isOpen="isDeleteLogDialogOpen" @closed="isDeleteLogDialogOpen = false">
            <template v-slot:title>
                Eliminar tarea {{ selectedLogToDelete.id }}
            </template>
            <template v-slot:description>
                ¿Estás seguro de que quieres eliminar la tarea {{ selectedLogToDelete.id }}?
            </template>
            <template v-slot:buttons>
                <PrimaryButton @click="deleteSelectedLog">Eliminar</PrimaryButton>
                <SecondaryButton @click="isDeleteLogDialogOpen = false">Cancelar</SecondaryButton>
            </template>
        </Dialog>

        <Dialog :isOpen="isUpdateLogDialogOpen" @closed="isUpdateLogDialogOpen = false">
            <template v-slot:title>
                Actualizar tarea {{ selectedLogToUpdate?.id }}
            </template>
            <template v-slot:description>
                <div class="col-span-6 sm:col-span-4 py-4">
                    <InputLabel for="updateLog" value="Tarea" />
                    <TextArea id="updateLog" type="text" class="mt-1 block w-full max-h-60"
                        v-model="selectedLogToUpdate.content" required />
                    <InputError :message="postForm.errors.log" class="mt-2" />
                </div>
            </template>
            <template v-slot:buttons>
                <PrimaryButton @click="patchSelectedLog">Actualizar</PrimaryButton>
                <SecondaryButton @click="isUpdateLogDialogOpen = false">Cancelar</SecondaryButton>
            </template>
        </Dialog>
    </AppLayout>
</template>
