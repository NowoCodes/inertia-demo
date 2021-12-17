<template>
    <div>
        <p>{{ $page.props.appName }}</p>
        <Link :href="route('home')">Home</Link>
        This is a welcome page ...
    </div>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: "Welcome2",
    components: {
        Link,
    }
}
</script>