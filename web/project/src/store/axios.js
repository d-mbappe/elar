import axios from 'axios'

export  const AXIOS = axios.create({
    baseURL: process.env.VUE_APP_URL,
    headers: {
        ContentType: 'application/json',
    },
})
