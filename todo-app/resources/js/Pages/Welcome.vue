<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <AppLayout title="Welcome">
        <div
            class="relative flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-4 sm:px-8 lg:max-w-5xl">
                <header class="pt-80 pb-8 text-center">
                    <h1
                        class="text-3xl sm:text-4xl font-extrabold text-blue-900 dark:text-blue-100 mb-2 tracking-tight"
                    >
                        Welcome to ToDo List App
                    </h1>
                    <p
                        class="text-base sm:text-lg text-blue-800 dark:text-blue-300 font-medium"
                    >
                        Your minimalistic app to manage daily tasks.
                    </p>
                </header>

                <main class="mt-2 flex flex-col items-center justify-center">
                    <div
                        class="w-full max-w-md bg-white dark:bg-blue-950 rounded-xl shadow-lg p-8 flex flex-col items-center gap-4"
                    >
                        <span
                            class="text-lg font-semibold text-blue-900 dark:text-blue-100"
                            >Start organizing your life now!</span
                        >
                        <span
                            ><a
                                href="/register"
                                class="text-sm text-blue-400 dark:text-blue-300 hover:underline"
                                >Create an account or log in to get started.</a
                            ></span
                        >
                    </div>
                </main>

                <footer
                    class="py-10 text-center text-xs text-blue-400 dark:text-blue-300 font-mono"
                >
                    &copy; 2025 ToDoListApp. Made
                    <span class="text-[#FF2D20]"></span> by Diogo.
                </footer>
            </div>
        </div>
    </AppLayout>
</template>
