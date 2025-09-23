<template>
    <div
        :class="[
            'bg-white rounded-xl shadow-lg flex flex-col items-center gap-4',
            compact ? 'w-full max-w-sm p-4' : 'w-full max-w-md p-8',
        ]"
    >
        <h1
            v-if="$slots.title"
            class="text-2xl sm:text-3xl font-extrabold text-blue-900 dark:text-blue-100 mb-1 tracking-tight text-center break-words max-w-full w-full"
            style="word-break: break-word; overflow-wrap: break-word"
        >
            <slot name="title"></slot>
        </h1>
        <p
            v-if="$slots.description"
            class="text-base text-blue-800 dark:text-blue-300 font-medium text-center mb-1"
        >
            <slot name="description"></slot>
        </p>
        <p
            v-if="$slots.due_date"
            class="text-xs text-blue-800 dark:text-blue-300 font-medium text-center mb-1"
        >
            <slot name="due_date"></slot>
        </p>
        <p
            v-if="$slots.is_completed"
            class="text-xs text-blue-800 dark:text-blue-300 font-medium text-center mb-1"
        >
            <slot name="is_completed"></slot>
        </p>
        <slot></slot>
        <div
            v-if="$slots.actions"
            class="w-full mt-2 flex gap-2 justify-center"
        >
            <slot name="actions"></slot>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    compact: {
        type: Boolean,
        default: false,
    },
});
</script>
