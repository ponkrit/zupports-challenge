import PublicApi from '../api/public-api'

const searchRestaurantListByPlaceName = async (searchName) => {
    const result = await PublicApi.searchRestaurantListByPlaceName(searchName)

    return result
}

export default {
    searchRestaurantListByPlaceName
}
