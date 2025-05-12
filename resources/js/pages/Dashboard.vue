<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type {  BreadcrumbItem, Domain, Auth } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';


let props = defineProps({
    domains: Array<Domain>,
    auth: Object
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

let editableRow = ref(0);

const addDomainForm = useForm({
  domain: "",
})

const editDomainForm = useForm({
  domain: "",
})

function addDomainHandler($event:any) {
    addDomainForm.post('dashboard', {
        onBefore: () => { },
        onSuccess: () => addDomainForm.reset()
    })
}

function editDomainHandler(domain: Domain, active: boolean) {
    if (active) {
        editableRow.value = domain.id
        editDomainForm.domain = domain.domain
    } else {
        editableRow.value = -1
        editDomainForm.reset()
    }
}

function updateDomainHandler(domain: Domain) {
    editDomainForm.put(`dashboard/${domain.id}`, {onSuccess: () => {
        editDomainForm.reset()
        editableRow.value = -1
    }});
}

function deleteDomainHandler(domain: Domain) {
    router.delete(`dashboard/${domain.id}`)
}

</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs" >
        <div class="container py-4 px-3 mx-auto">
            <h1>Hello {{ auth?.user.name }}</h1>
            <p>Welcome to your first Inertia app! With Bootstrap and Vite!</p>
            <form class="py-4" @submit.prevent="addDomainHandler">
                <label class="form-label" for="add-domain">Add domain</label>
                <div class="input-group">
                    <span class="input-group-text">https://</span>
                    <input class="form-control" name="add-domain" type="text" v-model="addDomainForm.domain" />
                    <button type="button" class="btn btn-outline-secondary btn-sm" @click="addDomainHandler">Add</button>
                </div>
                <div v-if="addDomainForm.errors.domain" class="text-body-secondary py-2">{{ addDomainForm.errors.domain }}</div>
            </form>
            <h3>Knowns domains</h3>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Domain name</th>
                        <th scope="col" class="tiny-column">Actions</th>
                    </tr>
                </thead>
                <tbody v-for="domain, i in domains">
                    <tr>
                        <td class="align-middle px-3 ">
                            <div v-if="domain.id === editableRow" class="row">
                                <div class="input-group col-4">
                                    <span class="input-group-text">https://</span>
                                    <input class="form-control" name="edit-domain" type="text" v-model="editDomainForm.domain" />
                                </div>
                                <div v-if="editDomainForm.errors.domain" class="text-body-secondary py-2 col-8">{{ editDomainForm.errors.domain }}</div>
                            </div>
                            <div v-else>
                                {{ domain.domain }}
                            </div>
                        </td>
                        <td class="text-center">
                            <div v-if="domain.id == editableRow">
                                <button type="button" class="btn btn-outline-secondary btn-sm" @click="updateDomainHandler(domain)">Update</button>
                                &nbsp;
                                <button type="button" class="btn btn-outline-info btn-sm" @click="editDomainHandler(domain, false)">Cancel</button>
                            </div>
                            <div v-else>
                                <button class="btn btn-outline-secondary btn-sm" @click="editDomainHandler(domain, true)">Edit</button>
                                &nbsp;
                                <button class="btn btn-outline-danger btn-sm" @click="deleteDomainHandler(domain)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>

<style lang="scss">

.tiny-column {
    width: 170px;
    text-align: center;
}

</style>
