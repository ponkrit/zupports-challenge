const post = async (url, data, headers = {}, attachAccessToken = true) => {
    try {
        const option = {
            method: 'POST',
            body: JSON.stringify(data)
        }

        const res = await _fetchData(url, option, headers, attachAccessToken)

        return res.json()
    } catch (err) {
        throw err
    }
}

const _fetchData = async (url, option = null, headers = {}) => {
    const defaultHeaders = {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }

    const mergeHeaders = Object.assign(defaultHeaders, headers)
    option.headers = mergeHeaders

    const res = await fetch(url, option)
    await _validateHTTPStatusSuccess(res)

    return res
}

const _validateHTTPStatusSuccess = async (res) => {
    const regExp = /(2[0-9][0-9])/
    const isSuccess = regExp.test(String(res.status))

    if (!isSuccess) {
        const response = await res.json()
        const err = new Error(response.message)
        err.status = res.status

        throw err
    }
}

export default {
    post
}
