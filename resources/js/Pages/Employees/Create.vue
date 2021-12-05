<template>
    <Head title="Departments" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Employee
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-show="form.hasErrors">
                            <div class="text-red-600 font-medium mb-4">
                                Please make the following corrections:
                            </div>
                        </div>

                        <form @submit.prevent="submit">
                            <!--                        phone-->
                            <div class="mb-4">
                                <Label for="department_id" value="Department"></Label>
                                <!--                                <select id="department_id" v-model="form.department_id" class="-->
                                <!--                                        focus:ring focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-1/2">-->
                                <!--                                    <option value="">Select</option>-->
                                <!--                                    <option v-for="d in department" :key="d.id" :value="d.id">-->
                                <!--                                        {{ d.name }}-->
                                <!--                                    </option>-->
                                <!--                                </select>-->
                                <Select id="department_id"
                                        :error="form.errors.department_id" class="mt-1 block w-1/2"
                                        options="department" model-value="form.department_id"
                                ></Select>
                                <InputError :message="form.errors.department_id"></InputError>
                            </div>

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
import Select from "@/Components/Select";

export default {
    components: {
        Select,
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
    props: {
        department: Object,
    },
    setup() {
        const form = useForm({
            department_id: null,
            name: null,
            email: null,
        })

        return {form}
    },
    methods: {
        submit() {
            this.form.post(route('employees.store'));
        },
        resetForm() {
            this.form.clearErrors();
            this.form.reset();
        },
    }
}
</script>
