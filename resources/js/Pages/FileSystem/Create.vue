<script setup>

import Navbar from "@/Layouts/Navbar.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";

const fileInput = ref(null)
const fileSelected = ref('')

const fileForm = useForm({
    file : null
})

const handleLoadFile = (event) => {
    const files = event.target.files
    if (files.length) {
        fileForm.file = files[0]
        fileSelected.value = files[0].name
    }
}

const handleClearFile = () => {
    fileForm.file = null;
    fileInput.value = null;
}

const submit = () => {
    fileForm.post(route('files.store'))
    fileForm.reset()
}

</script>

<template>
    <Navbar>
        <div class="relative h-screen flex justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover items-center">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="sm:max-w-lg w-full p-10 bg-white rounded-xl z-10">
                <Transition
                    mode="out-in"
                    name="flash"
                    tag="div"
                    enter-active-class="animate__animated animate__fadeInUp"
                    leave-active-class="animate__animated animate__fadeOutDown"
                    appear
                >
                    <p v-if="$page.props.flash.error" class="cursor-pointer bottom-3 right-3 bg-red-600 px-5 py-1 font-semibold text-white rounded-xl">
                        {{$page.props.flash.error}}
                    </p>
                </Transition>
                <Transition
                    mode="out-in"
                    name="flash"
                    tag="div"
                    enter-active-class="animate__animated animate__fadeInUp"
                    leave-active-class="animate__animated animate__fadeOutDown"
                    appear
                >
                    <p v-if="$page.props.flash.success" class="bottom-3 right-3 bg-green-600 px-5 py-1 font-semibold text-white rounded-xl">
                        {{$page.props.flash.success}}
                    </p>
                </Transition>
                <div class="text-center">
                    <h2 class="mt-5 text-4xl font-bold text-gray-900">
                        Cargar archivo!
                    </h2>
                </div>
                <form class="mt-8 space-y-3" @submit.prevent="submit">
                    <div class="grid grid-cols-1 space-y-2">
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 group text-center">
                                <div class="h-full w-full text-center flex flex-col items-center justify-center ">
                                    <div class="flex flex-auto max-h-48 w-2/5 mx-auto -mt-10">
                                        <img class="has-mask h-36 object-center" src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg" alt="freepik image">
                                    </div>
                                    <p class="pointer-none text-gray-500" v-if="!fileForm.file"><a href="" id="" class="text-blue-600 hover:underline">seleccione un archivo</a> de su computadora</p>
                                </div>
                                <div class="flex flex-col p-4 w-11/12 mx-auto">
                                    <b v-if="fileForm.file" class="text-green-600 my-2">{{fileSelected}}</b>
                                    <button v-if="fileForm.file" @click="handleClearFile" type="button" class="rounded-md bg-yellow-600 text-white py-1">
                                        Selecccionar nuevamente
                                    </button>
                                </div>
                                <input @input="handleLoadFile" type="file" class="hidden" ref="fileInput">
                            </label>
                        </div>
                    </div>
                    <p class="text-sm text-gray-300">
                        <span>Tipo de archivo: csv,xlsx,docx, doc, o tipos de excel</span>
                    </p>
                    <div>
                        <button type="submit" class="my-5 w-full flex justify-center bg-blue-500 text-white p-4  rounded-full tracking-wide
                                    font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                            Subir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Navbar>
</template>

<style scoped>

</style>
