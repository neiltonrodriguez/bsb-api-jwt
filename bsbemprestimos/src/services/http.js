import axios from 'axios'


const axiosInstace = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/v1/'
});

axiosInstace.interceptors.request.use((config) => {
    const token = localStorage.getItem('token')

    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }

    return config
}, (err) => {
    return Promise.reject(err)
})

export default axiosInstace
