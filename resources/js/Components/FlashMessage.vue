<template>
    <div
        v-if="$page.props.flash.success && show"
        class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded flex items-center justify-between bg-green-500"
    >
        <div class="py-4 text-white text-sm font-medium">
            {{ $page.props.flash.success }}
        </div>
        <button class="group mr-2 p-2" type="button" @click="show = false">
            <svg
                class="block w-2 h-2 fill-green-800 group-hover:fill-white"
                height="235.908"
                viewBox="278.046 126.846 235.908 235.908"
                width="235.908"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z"
                />
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: true,
        };
    },
};
</script>

