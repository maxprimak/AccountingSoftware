import Vue from 'vue'
import Router from 'vue-router'
import Signin from './views/sign/Sign'
import Signup from './views/sign/Signup'
import Forgot from './views/sign/Forgot'
import NotFound from './views/NotFound'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            component: Signin
        },
        {
            path: '/signin',
            name: 'signin',
            component: Signin
        },
        {
            path: '/signup',
            name: 'signup',
            component: Signup
        },
        {
            path: '/forgot',
            name: 'forgot',
            component: Forgot
        },
        {
            path: '/:any?',
            name: 'notfound',
            component: NotFound
        }
    ]
})
