<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto pt-24 pb-10 px-2">
            <h1
                class="text-4xl font-extrabold text-blue-900 dark:text-blue-100 mb-8 tracking-tight text-center drop-shadow-sm"
            >
                My Tasks
            </h1>
            <button
                @click="createTask"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-8 font-semibold hover:bg-blue-600 transition-all shadow-md w-fit flex items-center gap-2"
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
                        d="M12 4v16m8-8H4"
                    />
                </svg>
                Create Task
            </button>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8"
            >
                <TaskCard
                    v-for="task in tasks.data"
                    :key="task.id"
                    compact
                    class="transition-all duration-200 hover:scale-[1.03] hover:shadow-2xl bg-gradient-to-br from-blue-100 via-white to-blue-200 border border-blue-200 dark:from-blue-900 dark:via-blue-950 dark:to-blue-800 dark:border-blue-800"
                >
                    <template #title>
                        <span
                            class="text-2xl font-bold text-blue-900 dark:text-blue-100"
                            >{{ task.title }}</span
                        >
                    </template>
                    <template #description>
                        <span
                            :class="
                                task.is_completed
                                    ? 'line-through text-gray-500'
                                    : 'text-blue-900 dark:text-blue-100'
                            "
                            class="block text-base mb-2"
                        >
                            {{ task.description || "No description" }}
                        </span>
                    </template>
                    <template #due_date>
                        <span class="text-xs text-blue-700 dark:text-blue-300">
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
                            class="text-xs font-semibold"
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
                    <template #actions>
                        <button
                            @click="editTask(task.id)"
                            class="text-blue-500 hover:bg-blue-100 px-3 py-1 rounded-lg text-sm font-medium transition-all flex items-center gap-1"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5h2m-1 0v14m-7-7h14"
                                />
                            </svg>
                            Edit
                        </button>
                        <button
                            @click="deleteTask(task.id)"
                            class="text-red-500 hover:bg-red-100 px-3 py-1 rounded-lg text-sm font-medium transition-all flex items-center gap-1"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                            Delete
                        </button>
                    </template>
                </TaskCard>
            </div>
            <div class="flex justify-center gap-2 items-center w-full py-4 fixed bottom-10 left-0">
                <button
                    v-if="tasks.prev_page_url"
                    @click="goTo(tasks.prev_page_url)"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-600 transition-all shadow-md w-fit flex gap-2"
                >
                    Previous
                </button>
                <button
                    v-if="tasks.next_page_url"
                    @click="goTo(tasks.next_page_url)"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-600 transition-all shadow-md w-fit flex gap-2"
                >
                    Next
                </button>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import TaskCard from "@/Components/TaskCard.vue";

defineProps({
    tasks: Object,
});


function createTask() {
    router.get("/tasks/create");
}

function editTask(id) {
    router.get(`/tasks/${id}/edit`);
}

function deleteTask(id) {
    router.delete(`/tasks/${id}`);
}

function goTo(url) {
    router.visit(url);
}
</script>
