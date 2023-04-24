import axios from 'axios'
import authConfig from './config'

if (global?.window && global?.window.localStorage) {
    const token = localStorage.getItem(authConfig.storageTokenKeyName)
    console.log(token)
    if (token && (axios.defaults?.headers && axios.defaults.headers.common)) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
    }
}

// allow only 2XX status codes
axios.defaults.validateStatus = (status) => status >= 200 && status < 500

axios.defaults.baseURL = "http://127.0.0.1:8000/api"

