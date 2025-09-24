<template>
    <AppLayout>
        <div
            class="w-full min-h-screen pt-24 pb-10 px-2 flex flex-col items-center justify-center"
        >
            <h1
                class="text-4xl font-extrabold text-blue-900 dark:text-blue-100 mb-8 tracking-tight text-center drop-shadow-sm"
            >
                Task Details
            </h1>
            <button
                @click="goBack"
                class="mb-8 bg-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-600 transition-all shadow-md flex items-center gap-2"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
                Back to Tasks
            </button>
            <div class="flex justify-center w-full">
                <TaskCard
                    :key="task.id"
                    class="transition-all duration-200 hover:scale-[1.03] hover:shadow-2xl bg-gradient-to-br from-blue-100 via-white to-blue-200 border border-blue-200 dark:from-blue-900 dark:via-blue-950 dark:to-blue-800 dark:border-blue-800 p-10 max-w-2xl min-w-[350px] min-h-[350px] flex-1"
                >
                    <template #title>
                        <span
                            class="text-4xl font-extrabold text-blue-900 dark:text-blue-100"
                        >{{ task.title }}</span>
                    </template>
                    <template #description>
                        <span
                            class="block text-3xl mb-4"
                        >
                            {{ task.description || "No description" }}
                        </span>
                    </template>
                    <template #priority>
                        <span
                            class="text-xl font-semibold px-3 py-1 rounded-full"
                            :class="
                                task.priority === 'high'
                                    ? 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100'
                                    : task.priority === 'medium'
                                    ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100'
                                    : 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100'
                            "
                        >
                            {{
                                task.priority.charAt(0).toUpperCase() +
                                task.priority.slice(1)
                            }}
                        </span>
                    </template>
                    <template #due_date>
                        <span class="text-xl text-blue-700 dark:text-blue-300">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline h-4 w-4 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                            Due:
                            {{
                                task.due_date
                                    ? new Date(
                                          task.due_date
                                      ).toLocaleDateString()
                                    : "No due date"
                            }}
                        </span>
                    </template>
                    <template #is_completed>
                        <span
                            class="text-xl font-semibold"
                            :class="
                                task.is_completed
                                    ? 'text-green-600'
                                    : 'text-yellow-600'
                            "
                        >
                            <svg
                                v-if="task.is_completed"
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline h-4 w-4 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline h-4 w-4 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="2"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6v6l4 2"
                                />
                            </svg>
                            {{ task.is_completed ? "Completed" : "Pending" }}
                        </span>
                    </template>
                </TaskCard>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import TaskCard from "@/Components/TaskCard.vue";

const props = defineProps({
    task: Object,
});

function goBack() {
    router.get("/tasks");
}
</script>
