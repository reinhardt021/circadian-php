<template>
    <transition name='settings' enter-active-class='settings-show'>
        <div class="settings">
            <button class="button" id="settings-close" @click='closeSettings'>
                <svg width='14' height='14' xmlns='http://www.w3.org/2000/svg'>
                    <path fill='#333' fill-rule='evenodd' d='M5.586 7L.636 2.05A1 1 0 0 1 2.05.636L7 5.586l4.95-4.95a1 1 0 0 1 1.414 1.414L8.414 7l4.95 4.95a1 1 0 0 1-1.414 1.414L7 8.414l-4.95 4.95A1 1 0 0 1 .636 11.95L5.586 7z'/>
                </svg>
            </button>
            <button class="button" id="settings-volume" @click=''>
                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="24" height="22" viewBox="0 0 75 75">
                    <path d="M39.389,13.769 L22.235,28.606 L6,28.606 L6,47.699 L21.989,47.699 L39.389,62.75 L39.389,13.769z" style="stroke:#111;stroke-width:5;stroke-linejoin:round;fill:#111;"/>
                    <path d="M48,27.6a19.5,19.5 0 0 1 0,21.4M55.1,20.5a30,30 0 0 1 0,35.6M61.6,14a38.8,38.8 0 0 1 0,48.6" style="fill:none;stroke:#111;stroke-width:5;stroke-linecap:round"/>
                </svg>
            </button>
            <FlowDetails />
            <div class="flow">
                <h2 class="flow-title" v-text="currentFlow.title"></h2>
                <div class="tasks">
                    <AppTask
                        v-for='(taskId, index) in settings.taskOrder'
                        :task='tasks[taskId]'
                        :index='index'
                        :key='taskId'
                        @change-task='taskChange'
                        @remove-task='taskRemove'
                    />
                </div>
            </div>
            <div class="options">
                <button class="button settings-btn" @click='taskAdd'>
                    <svg width='24' height='22' xmlns='http://www.w3.org/2000/svg'>
                        <path fill='#333' fill-rule='evenodd' d='M 11 2 L 11 11 L 2 11 L 2 13 L 11 13 L 11 22 L 13 22 L 13 13 L 22 13 L 22 11 L 13 11 L 13 2 Z'/>
                    </svg>
                </button>
            </div>

        </div>
    </transition>
</template>

<script>
    import FlowDetails from './FlowDetails.vue'
    import AppTask from './AppTask.vue'
    import { updateCurrentTask } from '../helpers.js'

    export default {
        props: {
            isTimerActive: Boolean,
            currentFlow: Object,
            currentTask: Object,
            tasks: Object,
            settings: Object,
        },
        methods: {
            taskChange(newTask) {
                const newTasks = {
                    ...this.tasks,
                    [newTask.id]: newTask,
                };
                const newCurrentTask = (newTask.id == this.currentTask.id && !this.isTimerActive)
                    ? updateCurrentTask(this.currentTask, newTask)
                    : this.currentTask;
                this.$emit('task-change', newTasks, newCurrentTask);
            },
            taskRemove(data) {
                this.$emit('task-remove', data);
            },
            taskAdd() {
                this.$emit('task-add');
            },
            closeSettings() {
                this.$emit('close-settings');
            },
        },
        components: {
            FlowDetails,
            AppTask,
        },
    }
</script>

<style scoped>

</style>
