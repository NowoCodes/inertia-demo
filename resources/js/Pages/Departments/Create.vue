<template>
    <Head title="Departments" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Department
            </h2>
        </template>

        <div class="py-12">
            <!--            <div class="m-64 p-64">-->
            <!--                Some dummy text-->
            <!--            </div>-->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-show="form.hasErrors">
                            <div class="text-red-600 font-medium mb-4">
                                Please make the following corrections:
                            </div>
                        </div>

                        <form @submit.prevent="submit">
                            <!--                        name -->
                            <div class="mb-4">
                                <Label for="name" value="Name"></Label>
                                <Input id="name" v-model="form.name" :error="form.errors.name" autofocus
                                       class="mt-1 block w-1/2" required
                                       type="text"></Input>
                                <InputError :message="form.errors.name"></InputError>
                            </div>

                            <!--                        email-->
                            <div class="mb-4">
                                <Label for="email" value="Email"></Label>
                                <Input id="email" v-model="form.email" :error="form.errors.email"
                                       class="mt-1 block w-1/2" type="email"></Input>
                                <InputError :message="form.errors.email"></InputError>
                            </div>

                            <!--                        phone-->
                            <div class="mb-4">
                                <Label for="phone" value="Phone"></Label>
                                <Input id="phone" v-model="form.phone" :error="form.errors.phone"
                                       class="mt-1 block w-1/2" type="text"></Input>
                                <InputError :message="form.errors.phone"></InputError>
                            </div>

                            <!--                        submit-->
                            <div class="flex justify-end gap-2">
                                <ResetButton @click="resetForm">Reset</ResetButton>
                                <Button :loading="form.processing">Create</Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import AnchorLink from "@/Components/AnchorLink";
import { useForm } from '@inertiajs/inertia-vue3';
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import InputError from "@/Components/InputError";
import Button from "@/Components/Button";
import ResetButton from "@/Components/ResetButton";

export default {
    components: {
        ResetButton,
        Button,
        InputError,
        Input,
        Label,
        AnchorLink,
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    setup() {
        const form = useForm({
            name: null,
            email: null,
            phone: null,
        })

        return {form}
    },
    methods: {
        submit() {
            this.form.post(route('departments.store'), {
                // preserveScroll: (page) => Object.keys(page.props.errors).length,
            });
        },
        resetForm() {
            this.form.clearErrors();
            this.form.reset();
        },
    }
}
</script>
