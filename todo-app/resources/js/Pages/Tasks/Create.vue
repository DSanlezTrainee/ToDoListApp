<template>
    <AppLayout>
        <div
            class="min-h-screen flex items-center justify-center bg-transparent"
        >
            <div class="max-w-2xl w-full">
                <TaskCard>
                    <template #title>Create New Task</template>
                    <template #description>
                        Add a new task to organize your day.
                    </template>
                    <form
                        @submit.prevent="submit"
                        class="w-full flex flex-col gap-4"
                    >
                        <div>
                            <label
                                class="block text-sm font-semibold mb-1 text-blue-900 dark:text-blue-100"
                                for="title"
                            >
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input
                                v-model="form.title"
                                id="title"
                                type="text"
                                required
                                class="w-full px-3 py-2 border border-blue-200 dark:border-blue-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-950 dark:text-blue-100"
                                placeholder="Task title"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold mb-1 text-blue-900 dark:text-blue-100"
                                for="description"
                            >
                                Description
                            </label>
                            <textarea
                                v-model="form.description"
                                id="description"
                                rows="2"
                                class="w-full px-3 py-2 border border-blue-200 dark:border-blue-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-950 dark:text-blue-100"
                                placeholder="Optional description"
                            ></textarea>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label
                                    class="block text-sm font-semibold mb-1 text-blue-900 dark:text-blue-100"
                                    for="due_date"
                                >
                                    Due Date
                                </label>
                                <input
                                    v-model="form.due_date"
                                    id="due_date"
                                    type="date"
                                    class="w-full px-3 py-2 border border-blue-200 dark:border-blue-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-950 dark:text-blue-100"
                                />
                            </div>
                            <div class="flex-1">
                                <label
                                    class="block text-sm font-semibold mb-1 text-blue-900 dark:text-blue-100"
                                    for="priority"
                                >
                                    Priority
                                </label>
                                <select
                                    v-model="form.priority"
                                    id="priority"
                                    class="w-full px-3 py-2 border border-blue-200 dark:border-blue-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-950 dark:text-blue-100"
                                >
                                    <option value="">Select</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <template #actions>
                        <button
                            @click="submit"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition"
                        >
                            Create Task
                        </button>
                    </template>
                </TaskCard>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import TaskCard from "@/Components/TaskCard.vue";

const form = reactive({
    title: "",
    description: "",
    due_date: "",
    priority: "",
});

function submit() {
    router.post("/tasks", form);
}
</script>
