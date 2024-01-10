const API_BASE_URL = '/api'

// Sample build to use in service
// const url = POST.COMMENT.replace('{postId}', 1)
const API_URL_FORMAT = {
    SEARCH: '/search',
}

const buildServiceUrl = (baseUrl, serviceList) => {
    let result = {}

    Object.keys(serviceList).map(function (key, index) {
        result[key] = baseUrl + serviceList[key]
    })

    return result
}

export const API_URL = buildServiceUrl(API_BASE_URL, API_URL_FORMAT)
