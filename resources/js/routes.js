import ProductIndex from './components/products/index'
import ProductCreate from './components/products/create'
import ProductEdit from './components/products/edit'
import ProductShow from './components/products/show'

export const routes = [
    {
        name: 'products.index',
        path: '/',
        component: ProductIndex
    },
    {
        name: 'products.show',
        path: '/product/:id',
        component: ProductShow
    },
    {
        name: 'products.create',
        path: '/create',
        component: ProductCreate
    },
    {
        name: 'products.edit',
        path: '/edit/:id',
        component: ProductEdit
    }
];
