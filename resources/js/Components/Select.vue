<template>
    <select
        v-bind="{
      ...$attrs,
      onChange: ($event) => {
        $emit('update:modelValue', $event.target.value);
      },
    }"
        :class="classes"
        :value="modelValue"
        class="focus:ring focus:ring-opacity-50 rounded-md shadow-sm"
    >
        <option value="">-Please Select-</option>
        <option
            v-for="option in options"
            :key="option.id"
            :selected="option.id === modelValue"
            :value="option.id"
        >
            {{ option.label }}
        </option>
    </select>
</template>

<script>
export default {
    props: {
        error: {
            type: String,
            default: "",
        },
        modelValue: {
            type: [String, Number],
            default: "",
        },
        options: {
            type: Array,
            required: true,
        },
    },
    computed: {
        classes() {
            return this.error
                ? "border-red-300 focus:border-red-600 focus:ring-red-200"
                : "border-gray-300 focus:border-indigo-300 focus:ring-indigo-200";
        },
    },
};
</script>