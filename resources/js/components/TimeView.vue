<template>
    <div class="time-view">
        <span
            class="time-hours"
            v-text="time.hours"
        ></span>:<span
            class="time-minutes"
            v-text="time.minutes"
        ></span>:<span
            class="time-seconds"
            v-text="time.seconds"
        ></span>
    </div>
</template>

<script>
    export default {
        props: {
            time: Object,
        },
    }
</script>
