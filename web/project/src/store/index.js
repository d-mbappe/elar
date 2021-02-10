import Vue from 'vue'
import Vuex from 'vuex'
import {AXIOS} from './axios'


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
        login({commit, state}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                AXIOS.post('/api/auth/sign-in',  user)
                    .then(resp => {
                        const token = resp.data.accessToken
                        const user = resp.data.user

                        localStorage.setItem('token', resp.data.accessToken)
                        commit('auth_success', token, user)
                        AXIOS.defaults.headers.common['Authorization'] = 'Bearer ' + state.token
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
        register({commit, state}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                AXIOS.post( '/api/auth/sign-up',  user)
                    .then(resp => {
                        const token = resp.data.accessToken
                        const user = resp.data.user

                        localStorage.setItem('token', resp.data.accessToken)
                        // AXIOS.defaults.headers.common['Authorization'] = token
                        commit('auth_success', token, user)
                        AXIOS.defaults.headers.common['Authorization'] = 'Bearer ' + state.token

                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },

        getUser({commit, state}, ) {

            return new Promise((resolve, reject) => {

                AXIOS.get('/api/profile')
                    .then(resp => {
                        resp.data ? state.profile = resp.data : state.profile = {}

                    })
                    .catch(err => {
                        commit('auth_error', err)
                        reject(err)
                    })
            })

        }
    },

    modules: {}
})
