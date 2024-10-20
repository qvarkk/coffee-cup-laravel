<template>
    <div v-if="isLoading" class="inline-spinner" :style="`width: ${size}px; height: ${size}px;`"></div>
</template>

<script>
export default {
    name: "InlineLoadingSpinner",
    props: {
        isLoading: {
            type: Boolean,
            required: true,
        },
        size: {
            type: Number,
            required: false,
            default: 20,
        }
    },
};
</script>

<style scoped>
.inline-spinner {
    border: 3px solid rgba(0, 0, 0, 0.1);
    border-top-color: #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: inline-block;
    margin: 0 auto; /* Centers the spinner */
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
