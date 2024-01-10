<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <input type="text" name="place_name" id="place_name" class="form-control" v-model="searchName" placeholder="Place name">
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-primary btn-block" name="btnSearch" @click="onSearchButtonClick">Search</button>
                            </div>
                        </div>
                        <div v-if="restaurantList.length > 0">
                            <div class="row mt-5">
                                <div class="col-12">
                                    <h4 class="text-primary">Nearly restaurant list</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" v-for="restaurant in restaurantList" :key="restaurant.id">
                                    <div class="w-100 card m-1">
                                        <div class="card-body">
                                            <h5 class="card-title text-nowrap overflow-hidden" style="text-overflow: ellipsis;">{{ restaurant.name }}</h5>
                                            <p class="card-text" style="height: 70px; overflow: hidden;">
                                                Address: {{ restaurant.address }}
                                            </p>
                                            <div class="row">
                                                <div class="col-6">
                                                    Rating: {{ restaurant.rating }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { get } from 'lodash'
    import PublicService from '../services/public-service'

    export default {
        name: 'Home',
        created: async function () {
            const result = await this._searchRestaurantListByPlaceName(this.searchName)
            this.restaurantList = get(result, 'restaurantList', [])
        },
        data () {
            return {
                searchName: 'Bang sue',
                restaurantList: []
            }
        },
        methods: {
            _searchRestaurantListByPlaceName: async function (searchName) {
                const result = await PublicService.searchRestaurantListByPlaceName(searchName)

                return result
            },
            onSearchButtonClick: async function () {
                if (this.searchName.trim() === '') {
                    alert('Please enter place name')

                    return
                }

                try {
                    const result = await this._searchRestaurantListByPlaceName(this.searchName)
                    this.restaurantList = get(result, 'restaurantList', [])
                    console.log('restaurantList: ', this.restaurantList)
                } catch (err) {
                    alert(err.message)
                }
            }
        }
    }
</script>

<style scoped>

</style>
