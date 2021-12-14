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

                            <!--                        image-->
                            <div class="mb-4">
                                <Label for="image" value="Image"></Label>
                                <input ref="photo" class="hidden" type="file" @change="updatePhotoPreview">

                                <div v-show="!photoPreview && user.image" class="mt-2">
                                    <img :src="currentImage()" class="rounded-full h-20 w-20 object-cover">
                                </div>

                                <div v-show="photoPreview" class="mt-2">
                                  <span :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                      photoPreview + '\');'" class="block rounded-full w-20 h-20"></span>
                                </div>

                                <InputError :message="form.errors.image"></InputError>

                                <Button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">Select a New
                                    Photo
                                </Button>
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
            _method: 'PUT',
            name: props.user.name,
            email: props.user.email,
            image: props.user.image,
        })

        return {form}
    },
    props: {
        user: Object,
    },
    data() {
        return {
            photoPreview: null,
        }
    },
    methods: {
        submit() {
            if (this.$refs.photo) {
                this.form.image = this.$refs.photo.files[0];
            }
            this.form.post(route('update-profile', this.user.id), {
                preserveScroll: (page) => Object.keys(page.props.errors).length,
            });
        },
        resetForm() {
            this.form.clearErrors();
            this.form.reset();
        },
        currentImage() {
            return '/storage/' + this.user.image;
        },
        selectNewPhoto() {
            this.$refs.photo.click();
        },
        updatePhotoPreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            }
            reader.readAsDataURL(this.$refs.photo.files[0]);
        },
    }
}
</script>
