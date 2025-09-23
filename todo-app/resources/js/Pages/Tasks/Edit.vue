<template>
    <AppLayout>
        <div
            class="min-h-screen flex items-center justify-center bg-transparent"
        >
            <div class="max-w-2xl w-full">
                <TaskCard>
                    <template #title>Update Task</template>
                    <template #description>
                        Update the details of your task.
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
                            <span
                                v-if="errors.title"
                                class="text-red-500 text-xs"
                                >{{ errors.title }}</span
                            >
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
                            <div class="flex-2">
                                <label
                                    class="block text-sm font-semibold mb-1 text-blue-900 dark:text-blue-100"
                                    for="priority"
                                >
                                    Priority
                                </label>
                                <select
                                    v-model="form.priority"
                                    id="priority"
                                    required
                                    class="w-full px-3 py-2 border border-blue-200 dark:border-blue-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-950 dark:text-blue-100"
                                >
                                    <option value="">Select</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                            <div class="flex-1 ">
                                <label
                                    class="block text-sm font-semibold mb-1 text-blue-900 dark:text-blue-100 flex items-center gap-2"
                                    for="is_completed"
                                >
                                    <span
                                        v-if="form.is_completed"
                                        class="text-blue-900"
                                    >
                                        Complete</span
                                    >
                                    <span v-else class="text-blue-900"
                                        >Pending</span
                                    >
                                </label>
                                <div class="flex items-center justify-center mt-4">
                                    <input
                                        id="is_completed"
                                        type="checkbox"
                                        v-model="form.is_completed"
                                        class="ml-2"
                                    />
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full mt-2 flex gap-2 items-center justify-center"
                        >
                            <button
                                @click="router.visit('/tasks')"
                                type="button"
                                class="flex-1 bg-gray-600 hover:bg-gray-500 text-white font-semibold py-2 rounded-lg transition"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition"
                            >
                                Update Task
                            </button>
                        </div>
                    </form>
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
import { usePage } from "@inertiajs/vue3";

const { errors } = usePage().props;

const props = defineProps({ task: Object });

const form = reactive({
    title: props.task.title,
    description: props.task.description,
    due_date: props.task.due_date,
    priority: props.task.priority,
    is_completed: Boolean(props.task.is_completed),
});

function submit() {
    router.put(`/tasks/${props.task.id}`, form);
}
</script>
