<template>
    <th :class="{'cursor-pointer': sortHeader}"
        class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
        <slot />
        <span v-if="sortHeader" :class="{'float-right': sortHeader}">
          <span v-if="sortby === field">
            <span v-if="sort === 'DESC'">
              <svg class="w-4 h-4 ml-2"
                   fill="currentColor"
                   viewBox="0 0 20 20"
                   xmlns="http://www.w3.org/2000/svg"
              >
                <path
                    clip-rule="evenodd"
                    d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                    fill-rule="evenodd"
                />
              </svg>
            </span>
            <span v-else>
                <svg class="w-4 h-4 ml-2"
                     fill="currentColor"
                     viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg"
                >
                <path
                    clip-rule="evenodd"
                    d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                    fill-rule="evenodd"
                />
                </svg>
            </span>
          </span>
        </span>
    </th>
</template>

<script>
export default {
    name: "Heading",
    props: {
        sortHeader: {
            type: Boolean,
            default: false,
        },
        field: {
            type: String,
            default: "",
        },
        sortby: {
            type: String,
            default: "",
        },
        sort: {
            type: String,
            default: "",
        },
    },
};
</script>