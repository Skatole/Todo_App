// Pages
import Register from '../components/pages/Register'
import Login from '../components/pages/Login'
import Dashboard from '../components/pages/Dashboard'
import Add from '../components/pages/Posts/Add'
import AdminDashboard from '../components/pages/admin/Dashboard'
import store from '../services/store/store'
import Posts from "../components/pages/Posts/Posts";
import Reference from '../components/pages/Posts/Reference'

// Routes
const routes = [
    {
        path: '/',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            try {
                if (!store.getters['authenticated']) {
                    return next({
                        name: 'login'
                    })
                }
            } catch(e) {
                console.log(e);
            }
                next()
        },
        children: [
            {
                path: '',
                name: 'dashboard',
                component: Posts
            },
        ],
    },
    // USER ROUTES
    {
        path: '/add',
        name: 'add',
        component: Add,
        beforeEnter: (to, from, next) => {
            if (!store.getters['authenticated']) {
                return next({
                    name: 'login'
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
            if (!store.getters['authenticated']) {
                return next({
                    name: 'login'
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
