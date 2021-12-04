<template>
    <Link v-if="href" :class="classes"
          :href="href"
          class="flex-shrink-0 text-white border-0 py-2 px-3 focus:outline-none rounded text-lg mt-10 sm:mt-0"
    >
        <slot />
    </Link>
    <button v-else :class="classes"
            class="flex-shrink-0 text-white border-0 py-2 px-3 focus:outline-none rounded text-lg mt-10 sm:mt-0"
    >
        <slot />
    </button>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },

    props: {
        href: String,
        mode: {
            type: String,
            default: 'add',
        },
    },

    computed: {
        classes() {
            if (this.mode === 'add') {
                return 'bg-blue-600 hover:bg-blue-800'
            }
            if (this.mode === 'edit') {
                return 'bg-yellow-600 hover:bg-yellow-800'
            }
            if (this.mode === 'delete') {
                return 'bg-red-600 hover:bg-red-800'
            }
            if (this.mode === 'view') {
                return 'bg-green-600 hover:bg-green-800'
            }
            return 'bg-indigo-600 hover:bg-indigo-800';
        }
    }
}
</script>
