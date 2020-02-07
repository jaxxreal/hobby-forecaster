<template>
    <span class="dots-loader">{{ dots }}</span>
</template>

<script>
export default {
    data() {
        return {
            dots: '.'
        };
    },
    mounted() {
        this.timerId = setInterval(() => {
            this.dots = this.dots.length === 3 ? '.' : this.dots + '.';
        }, 300)
    },
    destroyed() {
        clearTimeout(this.timerId);
    }
}
</script>

<style scoped>
    .dots-loader {
        width: 10px;
        display: inline-block;
        text-align: left;
    }
</style>