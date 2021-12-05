<template>
    <Head title="Employees" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Employees
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="lg:w-3/3 flex justify-end">
                    <AnchorLink :href="route('employees.create')" mode="add">
                        Create Employee
                    </AnchorLink>
                </div>

                <div class="inline-block overflow-hidden min-w-full rounded-lg shadow mt-8">
                    <Table>
                        <template #head>
                            <Heading>Department</Heading>
                            <Heading>Name</Heading>
                            <Heading>Email</Heading>
                            <Heading>Actions</Heading>
                        </template>

                        <template #body>
                            <Row v-for="e in employees.data" :key="e.id">
                                <Cell>{{ e.department.name }}</Cell>
                                <Cell>{{ e.name }}</Cell>
                                <Cell>{{ e.email }}</Cell>
                                <Cell>
                                    <AnchorLink :href="route('employees.edit', e.id)" mode="edit">
                                        Edit
                                    </AnchorLink>
                                    <AnchorLink class="ml-3" mode="delete" @click="destroy(e.id)">
                                        Delete
                                    </AnchorLink>
                                </Cell>
                            </Row>
                        </template>
                    </Table>

                    <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
                        <Pagination :links="employees.links" />
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
        employees: Object,
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route('employees.destroy', id));
        }
    }
}
</script>
