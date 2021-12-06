<template>
    <p class="mb-0" v-if="value && value[identifier]">
        Document No : {{ value[identifier] }}
    </p>
</template>

<script>
export default {
    name: "DocumentValue",
    props: {
        value: {},
        identifier: {
            type: String
        }
    }
}
</script>