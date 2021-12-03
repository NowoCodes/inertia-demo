<template>
    <Head title="Departments" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Departments
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="lg:w-3/3 flex justify-end">
                    <AnchorLink :href="route('departments.create')" mode="add">
                        Create Department
                    </AnchorLink>
                </div>

                <div class="inline-block overflow-hidden min-w-full rounded-lg shadow mt-8">
                    <Table>
                        <template #head>
                            <Heading>Name</Heading>
                            <Heading>Email</Heading>
                            <Heading>Phone</Heading>
                            <Heading>Actions</Heading>
                        </template>

                        <template #body>
                            <Row v-for="d in departments.data" :key="d.id">
                                <Cell>{{ d.name }}</Cell>
                                <Cell>{{ d.email }}</Cell>
                                <Cell>{{ d.phone }}</Cell>
                                <Cell>
                                    <AnchorLink :href="route('departments.edit', d.id)" mode="edit">
                                        Edit
                                    </AnchorLink>
                                    <AnchorLink class="ml-3" mode="delete" @click="destroy(d.id)">
                                        Delete
                                    </AnchorLink>
                                </Cell>
                            </Row>
                        </template>
                    </Table>

                    <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
                        <Pagination :links="departments.links" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Table from "@/Components/Table/Table";
import Heading from "@/Components/Table/Heading";
import Row from "@/Components/Table/Row";
import Cell from "@/Components/Table/Cell";
import Pagination from "@/Components/Pagination";
import AnchorLink from "@/Components/AnchorLink";

export default {
    components: {
        AnchorLink,
        Pagination,
        Cell,
        Row,
        Heading,
        Table,
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    props: {
        departments: Object,
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route('departments.destroy', id));
        }
    }
}
</script>
