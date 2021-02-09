import axios from 'axios'

export  const AXIOS = axios.create({
    baseURL: `http://elar.loc`,
    headers: {
        ContentType: 'application/json',
        // Authorization: 'Bearer' + localStorage.getItem('token') ? localStorage.getItem('token') : ''
        // Authorization: 'Bearer ORNHlnQ0KFtpJE5CHFQQEy8eGo70d9RU_1612964825'
        Authorization: `Bearer ${localStorage.token}`
    },
})
