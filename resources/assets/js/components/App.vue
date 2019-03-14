<template>
    <div id="app">
        <header-component @add="add"></header-component>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-10">
                    <div class="heading py-5">
                        <h1>Restaurants</h1>
                    </div>
                    <div class="">
                        <div class="card-columns">
                            <restaurant-component
                                    v-for="restaurant in restaurants"
                                    v-bind="restaurant"
                                    :key="restaurant.id"
                                    @update="update"
                                    @delete="del"
                            ></restaurant-component>
                        </div>
                    </div>
                    <pagination :totalRows="totalRows" :currentPage="currentPage" :perPage="perPage" :hidden="totalRows <= perPage "></pagination>
                </div>
            </div>
        </div>
        <footer-component></footer-component>
        <!-- Modal Component for updating Restaurant-->
        <b-modal
                id="modalUpdate"
                ref="modal"
                title="Update Restaurant"
                @ok="RestaurantUpdate"
        >
            <form @submit.stop.prevent="handleSubmit">
                <input type="hidden" name="id" value="updateKeeper.id">
                <b-form-input type="text" placeholder="Enter Restaurant name" name="name"  v-model="updateKeeper.name" />
                <b-form-textarea placeholder="Enter Restaurant description" name="description"  v-model="updateKeeper.description" />
            </form>
        </b-modal>
        <!-- Modal Component for adding Restaurant-->
        <b-modal
                id="modalAdd"
                ref="modal"
                title="Add Restaurant"
                @ok="RestaurantAdd"
        >
            <form @submit.stop.prevent="handleSubmit">
                <b-form-input type="text" placeholder="Enter Restaurant name" name="name"  v-model="addKeeper.name" />
                <b-form-textarea placeholder="Enter Restaurant description" name="description"  v-model="addKeeper.description" />
            </form>
        </b-modal>
        <div class="loader-box" :hidden="mute">
            <ring-loader  :color="'#3AB982'" :size="'95px'"></ring-loader>
        </div>
    </div>
</template>

<script>
    import RestaurantComponent from "./RestaurantComponent";
    import HeaderComponent from "./HeaderComponent";
    import FooterComponent from "./FooterComponent";
    import Pagination from "./Pagination";
    import RingLoader from "vue-spinner/src/RingLoader";
    function Restaurant({ id, name, description}) {
        this.id = id;
        this.description = description;
        this.name = name;
    }
    export default {
        name: "App",
        components: {RingLoader, Pagination, FooterComponent, HeaderComponent, RestaurantComponent},
        data() {
            return {
                restaurants: [],
                records: [],
                mute: false,
                perPage:12,
                totalRows:0,
                currentPage:0,
                updateKeeper: { id:'',name:'',description:''},
                addKeeper: { name:'',description:''}
            }
        },
        methods: {
            RestaurantAdd() {
                window.axios.post('/api/restaurant', this.addKeeper).then(({ data }) => {
                    this.read();
                });
            },
            add(){
                this.$root.$emit('bv::show::modal','modalAdd', '#modalAdd')
            },
            read() {
                this.mute = true;
                window.axios.get('/api/restaurants').then(({ data }) => {
                    this.records = data;
                    this.totalRows = this.records.length;
                    this.renderRestaurant();
                });
            },
            update(id, name, description) {
                // To do
                this.updateKeeper.id = id;
                this.updateKeeper.name = name;
                this.updateKeeper.description = description;
                this.$root.$emit('bv::show::modal','modalUpdate', '#modalUpdate')
            },
            RestaurantUpdate(){
                window.axios.put('/api/restaurant/'+this.updateKeeper.id, this.updateKeeper).then(({ data }) => {
                    this.read();
                });
            },
            del(id) {
                window.axios.delete('/api/restaurant/'+id).then(({ data }) => {
                    this.read();
                });
            },
            renderRestaurant(){
                this.restaurants = [];

                for (let i = 0; i < this.perPage; i++) {
                    this.restaurants.push(new Restaurant(this.records[(i+(this.currentPage*this.perPage))]));
                }
                this.mute = false;
            },
            next(event){

                if(this.totalRows >(this.currentPage*this.perPage)){
                    this.currentPage = this.currentPage+1;
                    this.renderRestaurant();
                }else{
                    event.target.className += ' disabled'
                }
            },
            previous(event){
                if(this.currentPage!==0){
                    this.currentPage = this.currentPage-1;
                    this.renderRestaurant();
                }else{
                    event.target.className += ' disabled'
                }

            }
        },
        created() {
            this.read();
        }
    }
</script>

<style scoped>

</style>