import Vue from 'vue'
import Vuex from 'vuex'
import {AXIOS} from './axios'
// import AXIOS from "AXIOS";


Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user: {},
        profile: {}

    },

    getters : {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,

        profile: state => state.profile
    },

    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_success(state, token, user) {
            state.status = 'success'
            state.token = token
            state.user = user
        },
        auth_error(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = ''
            state.token = ''
        },
    },

    actions: {
        /*LOGIN*/
        login({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                AXIOS.post('/api/auth/sign-in',  user)
                    .then(resp => {
                        const token = resp.data.accessToken
                        const user = resp.data.user

                        localStorage.setItem('token', resp.data.accessToken)
                        // AXIOS.defaults.headers.common['Authorization'] = token

                        commit('auth_success', token, user)
                        resolve(resp)

                    })
                    .catch(err => {
                        commit('auth_error')
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },

        /*LOGOUT*/
        logout({commit}) {
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('token')
                delete AXIOS.defaults.headers.common['Authorization']
                resolve()
            })
        },

        /*REGISTER*/
        register({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                AXIOS.post( '/api/auth/sign-up',  user)
                    .then(resp => {
                        const token = resp.data.token
                        const user = resp.data.user
                        localStorage.setItem('token', resp.data.accessToken)
                        AXIOS.defaults.headers.common['Authorization'] = token
                        commit('auth_success', token, user)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },

        getUser(context) {
            return new Promise((resolve, reject) => {
                console.log('getUser')
                // commit('auth_request')
                AXIOS.get('/api/profile')
                    .then(resp => {
                        context.profile = resp.data
                        console.log('user')
                        console.log(context.profile)
                        // resolve(resp)
                        // console.log('user')
                        // console.log(resp.data)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        reject(err)
                    })
            })
            //     AXIOS
            //         .get('/profile', {
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'Authorization': 'Bearer '+ state.token
            //             }
            //         })
            //         .then(response => (this.info = response));
            // }

        }
    },

    modules: {}
})
