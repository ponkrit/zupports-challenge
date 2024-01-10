import bService from './base-api'
import { API_URL } from '../configs/service-url'

const searchRestaurantListByPlaceName = async (searchName) => {
    const data = {
        searchName: searchName
    }

    try {
        const result = await bService.post(API_URL.SEARCH, data)

        return result
    } catch (err) {
        throw err
    }
}


export default {
    searchRestaurantListByPlaceName
}
