<template>
    <input ref="input" :class="classes" :value="modelValue"
           class="focus:ring-opacity-50 rounded-md shadow-sm" @input="$emit('update:modelValue', $event.target.value)">
</template>

<script>
export default {
    props: ['modelValue', 'error'],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    },

    computed: {
        classes() {
            return this.error ?
                'border-red-600 focus:border-red-700 focus:ring focus:ring-red-200' :
                'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200'
        }
    }
}
</script>
