<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Domain, User, type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

let props = defineProps({
    users: Array<User>,
})

function concatDomains(domains: Array<Domain>) {
    return domains.map((e)=> {
        return e.domain
    })
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs" >
        <div class="container py-4 px-3 mx-auto">
            <h3>Knowns Users</h3>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Domains</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody v-for="user, i in users">
                    <tr>
                        <td class=" ">{{ user.id }}</td>
                        <td class=" ">{{ user.name }}</td>
                        <td class=" ">{{ user.email }}</td>
                        <td class=" ">{{ concatDomains(user.domains) }}</td>
                        <td class=" ">{{ user.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
