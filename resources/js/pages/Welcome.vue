<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs" >
        <div class="container py-4 px-3 mx-auto">
            <h1>Holla! Welcome page here</h1>
            <Link href="dashboard">Check dashboard</Link>
        </div>
    </AppLayout>
</template>
