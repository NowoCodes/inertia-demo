<template>
    <Head title="Departments" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User - {{ form.name }}
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

                        <div v-show="form.wasSuccessful">
                            <div class="text-green-600 font-medium mb-4">
                                Profile Updated.
                            </div>
                        </div>

                        <div v-show="form.recentlySuccessful">
                            <div class="text-green-600 font-medium mb-4">
                                Profile was updated.
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

                            <!--                        submit-->
                            <div class="flex justify-end gap-2">
                                <ResetButton @click="resetForm">Reset</ResetButton>
                                <Button :loading="form.processing">Update</Button>
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
import { Head } from '@inertiajs/inertia-vue3';
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
        BreezeAuthenticatedLayout,
        Head,
    },
    setup(props) {
        const form = useForm({
            name: props.user.name,
            email: props.user.email,
        })

        return {form}
    },
    props: {
        user: Object,
    },
    methods: {
        submit() {
            this.form.put(route('update-profile', this.user.id));
        },
        resetForm() {
            this.form.clearErrors();
            this.form.reset();
        },
    }
}
</script>
