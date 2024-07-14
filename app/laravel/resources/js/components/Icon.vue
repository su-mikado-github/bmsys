<template>
    <i :class="lastClass" :style="style"></i>
</template>
<script>
export default {
    props: {
        font: {
            type: String,
            required: true,
        },
        class: {
            type: String,
        },
        style: {
            type: String,
        },
    },

    data() {
        return {
            //
        };
    },

    computed: {
        lastClass() {
            return this.font + (!!this.class ? " " + this.class : "");
        },
    },
};
</script>
