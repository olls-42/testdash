<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <div v-show="message">
        <p class="form-text">
            {{ message }}
        </p>
    </div>
</template>
