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
                    <AnchorLink v-if="$page.props.can" :href="route('departments.create')" mode="add">
                        Create Department
                    </AnchorLink>
                </div>

                <div class="inline-block overflow-hidden min-w-full rounded-lg shadow mt-8">
                    <Table>
                        <template #head>
                            <Heading :sort=sort :sortHeader=true :sortby=sortby field="id" @click="sortColumn('id')">
                                ID
                            </Heading>
                            <Heading :sort=sort :sortHeader=true :sortby=sortby field="name"
                                     @click="sortColumn('name')">Name
                            </Heading>
                            <Heading :sort=sort :sortHeader=true :sortby=sortby field="email"
                                     @click="sortColumn('email')">Email
                            </Heading>
                            <Heading>Phone</Heading>
                            <Heading>Actions</Heading>
                        </template>

                        <template #body>
                            <Row v-for="d in departments.data" :key="d.id">
                                <Cell>{{ d.id }}</Cell>
                                <Cell>{{ d.name }}</Cell>
                                <Cell>{{ d.email }}</Cell>
                                <Cell>{{ d.phone }}</Cell>
                                <Cell>
                                    <AnchorLink v-if="d.can.edit" :href="route('departments.edit', d.id)" mode="edit">
                                        Edit
                                    </AnchorLink>
                                    <AnchorLink v-if="d.can.delete" class="ml-3" mode="delete" @click="destroy(d.id)">
                                        Delete
                                    </AnchorLink>
                                    <AnchorLink class="ml-3" mode="view" @click="employees(d.id)">
                                        View
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
        sortby: String,
        sort: String
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route('departments.destroy', id), {
                preserveScroll: true,
                preserveState: false,
            });
        },
        employees(id) {
            this.$inertia.visit(route('employees.index'), {
                method: 'get',
                data: {department_id: id}
            });
            // this.$inertia.get(route('employees.index'), {department_id: id});
        },
        sortColumn(col) {
            // reverse sort on column select
            let sort = this.sort;
            if (col === this.sortby) {
                if (this.sort === 'asc') {
                    sort = 'desc';
                } else {
                    sort = 'asc';
                }
            }
            this.$inertia.get(route('departments.index'), {
                sortby: col,
                sort: sort,
                page: this.departments.current_page
            })
        }
    }
}
</script>
