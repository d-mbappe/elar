import axios from 'axios'

export  const AXIOS = axios.create({
    baseURL: process.env.BASE_URL,
    headers: {
        ContentType: 'application/json',
    },
})
