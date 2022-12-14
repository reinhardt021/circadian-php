<template>
    <div id="timer" class="site">
        <h2>
            <i class="fas fa-bug"></i>
            <span v-text="currentFlow.title"></span>
        </h2>
        <AppTimer
            :is-timer-active='isTimerActive'
            :current-task='currentTask'
            @toggle-timer='toggleTimer'
        />
        <AppControls
            @reset-timer='resetTimer'
            @open-settings='toggleSettings'
        />
        <AppSettings
            :is-timer-active='isTimerActive'
            :current-flow='currentFlow'
            :current-task='currentTask'
            :tasks='tasks'
            :settings='settings'
            v-show='settings.isOpen'
            @task-change='updateTask'
            @task-remove='deleteTask'
            @task-add='createTask'
            @close-settings='toggleSettings'
        />
    </div>
</template>

<script>
    import AppTimer from './AppTimer.vue'
    import AppControls from './AppControls.vue'
    import AppSettings from './AppSettings.vue'

    import { showTime, formatTime, updateCurrentTask } from '../helpers.js'

    import WindMp3 from '../../audio/Wind-Mark_DiAngelo.mp3'
    import MetalGongMp3 from '../../audio/Metal_Gong-Dianakc.mp3'

    import { RepositoryFactory } from '../repositories/RepositoryFactory.js'
    const FlowRepository = RepositoryFactory.get('flows');

    const templateTask = {
        title: 'New Task',
        type: 'break',
        hours: 0,
        minutes: 0,
        seconds: 0,
        time: showTime(0, 0, 0),
        view: formatTime(0, 0, 0),
        nextTask: null,
        audioFile: '',
    };

    const task01 = {
        id: 21,
        title: 'Warm Up',
        type: 'break',
        hours: 0,
        minutes: 0,
        seconds: 30,
        audioFile: '',
    };
    const task02 = {
        id: 11,
        title: 'WORK',
        type: 'focus',
        hours: 0,
        minutes: 25,
        seconds: 0,
        audioFile: WindMp3,
    };
    const task03 = {
        id: 31,
        title: 'Break',
        type: 'break',
        hours: 0,
        minutes: 13,
        seconds: 0,
        audioFile: '',
    };

    const appState = {
        isTimerActive: false,

        // todo: move this to UserTimerSettings
        currentFlow: {
            id: 13,
            title: 'Pomodoro Flow'
        },

        // todo: move this to UserTimerSettings
        currentTask: {
            firstTask: task01.id,
            ...task01,
            time: showTime(task01.hours, task01.minutes, task01.seconds),
            view: formatTime(task01.hours, task01.minutes, task01.seconds),
            nextTask: task02.id,
            timer: null, // used to keep track of interval of counting down
            audio: null, // used to keep track of Audio files being played
            volume: 75, // default to 75% audio
        },

        // todo: get this from API for UserTimerSettings
        settings: {
            isOpen: false,
            autoPlayTasks: true,
            taskOrder: [task01.id, task02.id, task03.id], // todo: move this to currentFlow
            loopTasks: true,
            timerAudioFile: MetalGongMp3,
            audio: null,
        },

        flows: {},

        tasks: {
            [task01.id]: {
                ...task01,
                time: showTime(task01.hours, task01.minutes, task01.seconds),
                view: formatTime(task01.hours, task01.minutes, task01.seconds),
                nextTask: task02.id,
            },
            [task02.id]: {
                ...task02,
                time: showTime(task02.hours, task02.minutes, task02.seconds),
                view: formatTime(task02.hours, task02.minutes, task02.seconds),
                nextTask: task03.id,
            },
            [task03.id]: {
                ...task03,
                time: showTime(task03.hours, task03.minutes, task03.seconds),
                view: formatTime(task03.hours, task03.minutes, task03.seconds),
                nextTask: null,
            },
        },
    };

    function playAudio(filePath, volumePercent, loop) {
        if (filePath == '') {
            return null;
        }
        var audio = new Audio(filePath);
        audio.loop = loop ? loop : false;
        audio.volume = volumePercent / 100;
        audio.play();

        return audio;
    }

    function countdownTimeLoop(app) {
        const { tasks, $data, currentTask, settings } = app;
        const hours = Number($data.currentTask.hours);
        const minutes = Number($data.currentTask.minutes);
        const seconds = Number($data.currentTask.seconds);

        if (seconds > 0) {
            currentTask.seconds--;
        }

        if (seconds == 0 && minutes > 0) {
            currentTask.minutes--;
            currentTask.seconds = 59;
        }

        if (seconds == 0 && minutes == 0 && hours > 0) {
            currentTask.hours--;
            currentTask.minutes = 59;
            currentTask.seconds = 59;
        }

        if (seconds == 1 && minutes == 0 && hours ==0) {
            if (app.currentTask.audio) {
                app.currentTask.audio.pause();
            }
            app.settings.audio = playAudio(app.settings.timerAudioFile, currentTask.volume);
        }

        if (seconds == 0 && minutes == 0 && hours ==0) {
            app.isTimerActive = false;
            clearInterval(currentTask.timer);

            if (!settings.autoPlayTasks) {
                return;
            }

            if (!currentTask.nextTask && !settings.loopTasks) {
                return;
            }

            const nextTask = currentTask.nextTask
                ? tasks[currentTask.nextTask]
                : tasks[currentTask.firstTask];

            app.currentTask = updateCurrentTask(currentTask, nextTask);
            app.isTimerActive = true;
            app.currentTask.timer = setInterval(countdownTimeLoop, 1000, app);
            app.currentTask.audio = playAudio(nextTask.audioFile, currentTask.volume, true);
        }

        currentTask.time = showTime(currentTask.hours, currentTask.minutes, currentTask.seconds);
        currentTask.view = formatTime(currentTask.hours, currentTask.minutes, currentTask.seconds);
    }

    export default {
        data: function () {
            //todo: find out proper styling for this to be consistent
            return appState;
        },
        // created() {
        //     this.fetch();
        // },
        methods: {
            // async fetch () {
                // const { data } = await FlowRepository.get(true, true);

                // can probably do without this if given typehinting >> todo: typescript
                // if (data.hasOwnProperty('data') && Array.isArray(data.data)) {
                //     const userFlows = data.data.reduce(function (flows, flow) {
                //         flows[flow.id] = flow;
                //
                //         return flows;
                //     }, {});
                //
                //     this.flows = userFlows;
                // }
            // },
            toggleTimer() {
                const self = this;

                // toggle Timer play and pause button
                self.isTimerActive = !self.isTimerActive;

                // start or stop the timer countdown if Timer is clicked
                if (self.isTimerActive) {
                    if (self.currentTask.audio) {
                        self.currentTask.audio.play();
                    } else {
                        self.currentTask.audio = playAudio(self.currentTask.audioFile, self.currentTask.volume, true);
                    }
                    self.currentTask.timer = setInterval(countdownTimeLoop, 1000, self);
                } else {
                    if (self.currentTask.audio) {
                        self.currentTask.audio.pause();
                    }
                    clearInterval(self.currentTask.timer);
                }
            },
            resetTimer() {
                const { currentTask, tasks } = this;
                if (currentTask.audio) {
                    currentTask.audio.pause();
                }
                clearInterval(this.currentTask.timer);
                this.isTimerActive = false;

                // if currentTask.firstTask == null OR there are no more tasks
                // then just reset to the currentTask
                // or reset to the first task in the flow
                const nextTask = (currentTask.firstTask === null)
                    ? currentTask
                    : tasks[currentTask.firstTask];

                this.currentTask = updateCurrentTask(currentTask, nextTask);
            },
            toggleSettings() {
                this.settings.isOpen = !this.settings.isOpen;
            },
            createTask() {
                function getRandomInt(min, max) {
                    min = Math.ceil(min);
                    max = Math.floor(max);

                    return Math.floor(Math.random() * (max - min)) + min;
                }
                const { currentTask, settings:{ taskOrder } } = this;
                const newTaskId = getRandomInt(500, 1000);

                // if there are no more tasks in the flow
                if (taskOrder.length === 0) {
                    // then update the currentTask.firstTask to the new task
                    this.currentTask.firstTask = newTaskId;
                }

                if (taskOrder.length > 0) {
                    const previousTask = taskOrder[taskOrder.length - 1];
                    this.tasks[previousTask].nextTask = newTaskId;
                }

                // if the current task comes before this new task
                if (currentTask.nextTask == null) {
                    // then update currentTask.nextTask to the new task
                    this.currentTask.nextTask = newTaskId;
                }

                const newTask = {
                    id: newTaskId,
                    ...templateTask,
                };
                this.tasks[newTaskId] = newTask;
                this.settings.taskOrder = taskOrder.concat([newTaskId]);
            },
            deleteTask(taskId) {
                const { isTimerActive, currentTask, settings:{ taskOrder }, tasks } = this;
                const thisTaskIndex = taskOrder.indexOf(taskId);
                const taskToDelete = tasks[taskId];

                // if the taskToDelete is the first task then update the firstTask
                if (thisTaskIndex == 0) {
                    this.currentTask.firstTask = taskToDelete.nextTask;
                }

                if (thisTaskIndex > 0) {
                    // update the Tasks linked list pointer in the previous Task
                    this.tasks[taskOrder[thisTaskIndex - 1]].nextTask = taskToDelete.nextTask;
                }

                // update the currentTask.nextTask if this points to the task to be deleted
                if (currentTask.nextTask == taskId) {
                    this.currentTask.nextTask = taskToDelete.nextTask;
                }

                // if the currentTask is deleted then update if timer is inactive
                if (currentTask.id == taskId && !isTimerActive && taskToDelete.nextTask) {
                    this.currentTask = updateCurrentTask(currentTask, tasks[taskToDelete.nextTask]);
                }

                // remove Task from taskOrder list and from Tasks linked list
                this.settings.taskOrder = taskOrder.filter(task => task != taskId);
                delete this.tasks[taskId];
            },
            updateTitle(newTask) {
                this.tasks[newTask.id] = newTask;
                if (newTask.id == this.currentTask.id && !this.isTimerActive) {
                    this.currentTask = updateCurrentTask(this.currentTask, newTask);
                }
            },
            updateTask(newTasks, newCurrentTask) {
                this.tasks = newTasks;
                this.currentTask = newCurrentTask;
            },
        },
        components: {
            AppTimer,
            AppControls,
            AppSettings,
        },
    };
</script>

<style scoped>

</style>
