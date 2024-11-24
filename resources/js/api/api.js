import axios from "axios";
import router from "@/router.js";

const api = axios.create()

let baseURL = 'http://localhost:8000'

api.defaults.baseURL = baseURL

api.interceptors.request.use(config => {

    if (localStorage.getItem('access_token')) {
        config.headers['authorization'] = `Bearer ${localStorage.getItem('access_token')}`
    }

    return config
}, error => {
    return error
});

api.interceptors.response.use({}, error => {

    if (error.response.data.message === 'Token has expired' ||
        // nah this one doesn't make sense, but idk how to fix it 💀
        error.request.responseURL === 'http://localhost:8000/api/auth/me' && localStorage.getItem('access_token')) {
        return axios.post(`${baseURL}/api/auth/refresh`, {}, {
            headers: {
                authorization: `Bearer ${localStorage.getItem('access_token')}`
            }
        }).then(res => {
            localStorage.setItem('access_token', res.data.access_token)

            error.config.headers['authorization'] = `Bearer ${res.data.access_token}`
            return api.request(error.config)
        }).catch(err => {
            localStorage.removeItem('access_token')
        });
    }

    if (error.status === 401) {
        localStorage.removeItem('access_token')
        router.push({name: 'user.login'})
    }

    return {
        response: error.response,
        status: error.status,
        message: error.message,
        error: error.response.data.error
    }
});

export default api
