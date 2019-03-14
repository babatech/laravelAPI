<template>
    <div class="card text-center Restaurant">
        <div class="card-body">
            <h4 class="card-title">{{ name | properCase }}</h4>
            <p class="card-text">{{ description | properCase }}</p>
            <hr class="my-4">
            <button class="btn btn-primary btn-lg" @click="dele">Delete</button>
            <button class="btn btn-info btn-lg" @click="update">Update</button>

        </div>
    </div>
</template>

<script>
    export default {
        name: "RestaurantComponent",
        props: ['id', 'name', 'description'],
        methods: {
            update() {
                this.$emit('update', this.id, this.name, this.description);
            },
            dele() {
                this.$emit('delete', this.id);
            }
        },
        filters: {
            properCase(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        }
    }

</script>

<style scoped>

</style>