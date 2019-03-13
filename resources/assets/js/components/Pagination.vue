<template>
    <div class="text-center">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item" >
                    <button class="page-link" aria-label="Previous" @click="previous" :disabled="currentPage===0" >
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </button>
                </li>
                <li class="page-item">
                    <button class="page-link" aria-label="Next" @click="next" :disabled="totalRows >(currentPage*perPage)">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: ['totalRows', 'perPage', 'currentPage'],
        methods:{
            next(){
                this.$emit('next');
            },
            previous(){
                this.$emit('previous');
            }
        }
    }
</script>

<style scoped>

</style>