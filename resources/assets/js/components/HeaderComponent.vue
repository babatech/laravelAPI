<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Laravel Demo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#" @click="add">Add</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "HeaderComponent",
        methods:{
            add(){
                this.$emit('add');
            }
        }
    }
</script>

<style scoped>

</style>