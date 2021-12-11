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

                <div class="lg:w-3/3 flex justify-between">
                    <Select id="department_id" v-model="department_id"
                            :options="departments" class="mt-1 block w-1/3"
                            @change="getEmployees(department_id)"
                    ></Select>

                    <AnchorLink :href="route('employees.create')" mode="add">
                        Create Employee
                    </AnchorLink>
                </div>

                <div class="inline-block overflow-hidden min-w-full rounded-lg shadow mt-8">
                    <Table>
                        <template #head>
                            <Heading>ID</Heading>
                            <Heading>Name</Heading>
                            <Heading>Department</Heading>
                            <Heading>Email</Heading>
                            <Heading>Actions</Heading>
                        </template>

                        <template #body>
                            <Row v-for="e in employees" :key="e.id">
                                <Cell>{{ e.id }}</Cell>
                                <Cell>{{ e.name }}</Cell>
                                <Cell>{{ e.department }}</Cell>
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
import AnchorLink from "@/Components/AnchorLink";
import Select from "@/Components/Select";

export default {
    components: {
        Select,
        AnchorLink,
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
        departments: Object,
        department_id: [String, Number],
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route('employees.destroy', id), {preserveScroll: true});
        },
        getEmployees(department_id) {
            this.$inertia.get(route('employees.index'), {department_id: department_id}, {only: ['employees', 'department_id']})
        }
    }
}
</script>
