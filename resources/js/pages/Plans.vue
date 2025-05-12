<script setup lang="ts">
import type { BreadcrumbItem, Plan, Auth } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { useTemplateRef, onMounted } from 'vue'
import { Head, router, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Plans',
        href: '/plans',
    },
];

let props = defineProps<{
    auth: Auth,
    plans: Array<Plan>,
    current_plan: Plan | null,
}>()

const cardBody = useTemplateRef<Array<HTMLDivElement> | null>('card-body')

onMounted(() => {
    // dirty css hack for copy&pasted html template
    let maxHeigh = 0;
    cardBody.value?.forEach(function(e) {
        if (e.clientHeight > maxHeigh) {
            maxHeigh = e.clientHeight
        }
    })
    cardBody.value?.forEach(function(e) {
        e.style.height = maxHeigh + 'px'
    })
})

const buyItForm = useForm({
  price_plan_id: 0,
})

function buyIt(planId: number) {
    if (props.auth && props.auth.user) {
        buyItForm.price_plan_id = planId
        buyItForm.post(`/user/${props.auth?.user.id}/buy/${planId}`)

        return;
    }

    router.get('login')
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs" >
        <div class="container py-4 px-3 mx-auto">
            <h3>Chose you plan</h3>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                <div class="col" v-for="plan in plans">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">{{ plan.plan_name }}</h4>
                        </div>
                        <div class="card-body" >
                            <h1 class="card-title pricing-card-title">{{ plan.price }}<small class="text-body-secondary fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4" ref="card-body">
                                <li v-for="feature, key in plan.features">{{ key }}:&nbsp;{{ feature }}</li>
                            </ul>
                            <input type="hidden" v-model="buyItForm.price_id"/>
                            <div v-if="plan.id !== current_plan?.id">
                                <button type="button" class="w-100 btn btn-lg btn-outline-primary" @click="buyIt(plan.id)">Buy</button>
                            </div>
                            <div v-else>
                                <button type="button" class="w-100 btn btn-lg btn-dark" disabled>Already have</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
