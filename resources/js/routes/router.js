
// Pages
import Home from '../components/pages/Home'
import Register from '../components/pages/Register'
import Login from '../components/pages/Login'
import Dashboard from '../components/pages/Dashboard'
import Add from '../components/pages/Add'
import AdminDashboard from '../components/pages/admin/Dashboard'
import store from '../services/store/store'

// Routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']) {
                return next({
                    name:'login'
                })
            }
            next()
        }
    },
    // USER ROUTES
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']) {
                return next({
                    name:'login'
                })
            }
            next()
        }
    },
    {
        path: '/add',
        name: 'add',
        component: Add,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']) {
                return next({
                    name:'login'
                })
            }
            next()
        }
    },
    // ADMIN ROUTES
    {
        path: '/admin',
        name: 'admin.dashboard',
        component: AdminDashboard,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']) {
                return next({
                    name:'login'
                })
            }
            next()
        }
    },
    // Auth routes
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
]

export default routes
