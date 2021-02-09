import Vue from 'vue'
import VueRouter from 'vue-router'
import Authentication from '../views/Authentication.vue'
import Main from "../views/Main";
import store from "../store";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Authentication',
    component: Authentication
  },

  {
    path: '/main',
    name: 'Main',
    component: Main,
    // beforeEnter: (to, from, next) => {
    //   console.log(to)
    //   console.log(from)
    //   //res.status === 200 ? next({name: 'Main' }) : next({ name: 'Authentication' })
    //   // store.dispatch('getUser').then(res => {
    //   //   console.log(res)
    //   //   res.status === 200 ? next({name: 'Main' }) : next({ name: 'Authentication' })
    //   // })
    // }
  }
  // {
  //   path: '/about',
  //   name: 'About',
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  // }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
