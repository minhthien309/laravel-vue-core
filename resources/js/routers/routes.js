import Layout from '../components/Layout'
import Login from '../components/Login'
import Dashboard from '../components/Dashboard'
import FileManager from '../components/FileManager'

export default [{
    path: '/',
    component: Layout,
    name: 'Layout',
    meta: {
        permission: []
    },
    children: [{
        path: '/',
        component: Dashboard,
        name: 'Dashboard',
        meta: {
            permission: []
        }
    },
    {
        path: '/file-manager',
        component: FileManager,
        name: 'FileManager',
        meta: {
            permission: []
        }
    }]
},{
    path: '/login',
    component: Login,
    name: 'Login',
    meta: {
        permission: []
    }
}]