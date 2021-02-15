/*Системные переменыне*/
import Vue from 'vue'
import VueRouter from 'vue-router'
import Main from "../views/Main";
import store from "../store";
import AXIOS from "axios";
/*Компоненты*/
import Authentication from '../views/Authentication.vue'
import Account from "../views/Account";
import Profile from "../components/Profile";
import NewPassword from "../components/NewPassword";


Vue.use(VueRouter)

const routes = [
  {
    path: '/auth',
    name: 'Authentication',
    component: Authentication
  },

  {
    path: '/account',
    name: 'Account',
    component: Account,
    children: [
        {
          path: 'profile',
          name: 'Profile',
          component: Profile
        },

      {
        path: 'new-password',
        name: 'NewPassword',
        component: NewPassword
      },
      ]

  },

  {
    path: '/main',
    name: 'Main',
    component: Main,
  }
]

const router = new VueRouter({
  mode: 'history',
  base: '/',
  // base: process.env.VUE_APP_URL,
  routes
})

router.beforeEach((to, from, next) => {
  /*Блокирует переход на страницы для неавторизованного пользователя*/
  if (store.getters['isLoggedIn'] || to.path === '/auth') {
    next();
  } else {
    next("/auth");
  }

  /*На странцие аккаунта сразу отображает Личные данные в профиле*/
  if (store.getters['isLoggedIn'] && to.path === '/account') {
    next('/account/profile')
  } else {}

  /*Получает пользователя на всех страницах, кроме авторизации*/
  if(to.path !== '/auth') {
    store.dispatch("getUser")
  }

});

export default router
