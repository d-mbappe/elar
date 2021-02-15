import Vue from 'vue'
import Vuex from 'vuex'
import {AXIOS} from './axios'


Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user: {},
        profile: {},
        tmp_access_token: ''

    },

    getters : {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,

        profile: state => state.profile,

        tmp_access_token: state => state.tmp_access_token
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
            state.profile = {}
        },

        set_profile(state, payload) {
            state.profile = payload
        },

        set_token(payload) {
            localStorage.setItem('token', payload.token)
        },

        set_auth_token () {
            AXIOS.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.token
        },

        get_cookie (state) {
            let cookie = document.cookie
            let cookie_split = cookie.split('; ')
            let tmp_access_token;

            cookie_split.filter(item => {
                if(item.indexOf('tmp_access_token') +1 ) {
                    tmp_access_token =   item.split('=')[1]
                }
            })

            state.tmp_access_token = tmp_access_token
            tmp_access_token ? localStorage.setItem('token', tmp_access_token) : ''
        }




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

                        // localStorage.setItem('token', resp.data.accessToken)
                        commit('auth_success', token, user)
                        commit('set_token', token)
                        commit('set_auth_token')

                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error')
                        localStorage.removeItem('token')
                        Vue.prototype.$flashStorage.flash('Неверный логин или пароль', 'error')
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

                        // localStorage.setItem('token', resp.data.accessToken)
                        commit('auth_success', token, user)
                        commit('set_token', token)
                        commit('set_auth_token')

                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        localStorage.removeItem('token')
                        Vue.prototype.$flashStorage.flash('Пользователь с таким email уже существует', 'error')

                        reject(err)
                    })
            })
        },

        getUser({commit, state} ) {
            return new Promise((resolve, reject) => {
                commit('set_auth_token')

                AXIOS.get('/api/profile')
                    .then(resp => {
                        commit('set_profile', resp.data)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        reject(err)
                    })
            })

        },

        saveProfile({commit, state}, profile) {
            return new Promise((resolve, reject) => {
                commit('set_auth_token')

                AXIOS.patch('/api/profile', profile)
                    .then(resp => {
                        commit('set_profile', resp.data)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        reject(err)
                    })
            })

        },




    },

    modules: {}
})
