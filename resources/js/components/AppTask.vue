<template>
    <div class='task'>
        <button class='remove-task' @click='removeTask(task.id)'>
            <svg width='14' height='14' xmlns='http://www.w3.org/2000/svg'>
                <path fill='grey' fill-rule='evenodd' d='M5.586 7L.636 2.05A1 1 0 0 1 2.05.636L7 5.586l4.95-4.95a1 1 0 0 1 1.414 1.414L8.414 7l4.95 4.95a1 1 0 0 1-1.414 1.414L7 8.414l-4.95 4.95A1 1 0 0 1 .636 11.95L5.586 7z'/>
            </svg>
        </button>
        <div class='task-content'>
            <div class='task-title' contenteditable='true' v-text='task.title' @blur='changeTitle'></div>
            <TimeView :time='task.view'/>
            <TimeView :time='timeFormat'/>
            <input class='task-input' type='range' min='0' max='24' data-type='task-hours' v-model='task.hours' @input='changeTime'/>
            <input class='task-input' type='range' min='0' max='59' data-type='task-minutes' v-model='task.minutes' @input='changeTime'/>
            <input class='task-input' type='range' min='0' max='59' data-type='task-seconds' v-model='task.seconds' @input='changeTime'/>
        </div>
    </div>
</template>

<script>
    import TimeView from "./TimeView.vue";
    import { showTime, formatTime } from '../helpers.js'

    export default {
        data: function () {
            return {
                timeFormat: {
                    hours: 'hh',
                    minutes: 'mm',
                    seconds: 'ss',
                },
            };
        },
        props: {
            task: Object,
        },
        methods: {
            removeTask(taskId) {
                this.$emit('remove-task', taskId);
            },
            changeTitle(e) {
                const newTask = {
                    ...this.task,
                    title: e.target.innerText.trim(),
                };
                this.$emit('change-task', newTask);
            },
            changeTime(e) {
                const { dataset:{ type }, value } = e.target;
                const timePeriod = type.replace('task-', '');
                const newTask = {
                    ...this.task,
                    [timePeriod]: Number(value),
                };
                newTask.time = showTime(newTask.hours, newTask.minutes, newTask.seconds);
                newTask.view = formatTime(newTask.hours, newTask.minutes, newTask.seconds);
                this.$emit('change-task', newTask);
            },
        },
        components: {
            TimeView,
        },
    }
</script>

<style scoped>

</style>
