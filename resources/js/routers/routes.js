import Welcome from '../components/Welcome'
import Page from '../components/Page'

export default [{
    path: '/',
    component: Welcome,
    name: 'Welcome',
    meta: {
        permission: []
    }
},
{
    path: '/page',
    component: Page,
    name: 'Page',
    meta: {
        permission: []
    }
}]