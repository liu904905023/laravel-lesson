<template>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item" v-for="task in tasks" v-text="task"></li>
        </ul>
        <form @submit.prevent="addTask" method="post">
            <div class="form-group">
                <input v-model="newTask" type="text" class="form-control" placeholder="Add Tasks">

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</template>

<script>
    export default {
        data(){
            return {
                tasks:[],
                newTask:''
            }
        },
        mounted() {
            axios.get('/tasks').then(response=>{
                this.tasks = response.data;
            });
            window.Echo.channel('tasks').listen('TaskCreated',e=>{
                this.tasks.push(e.task.body)
            });
        },
        methods:{
            addTask(){
                axios.post('/tasks', {'body': this.newTask});
                this.tasks.push(this.newTask);
                this.newTask=''
            }
        }

    };
</script>
