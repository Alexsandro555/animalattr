import ListProduct from '@product/vue/Product/ListProduct'
import EditProduct from '@product/vue/Product/EditProduct'
import ListAttribute from '@product/vue/Attribute/ListAttribute'
import EditAttribute from '@product/vue/Attribute/EditAttribute'

export const routes = [
  {
    path: '/',
    name: 'list-product',
    component: ListProduct
  },
  {
    path: '/Product/Edit/:id',
    name: 'edit-product',
    component: EditProduct,
    props: true
  },
  {
    path: '/attributes',
    name: 'list-attributes',
    component: ListAttribute
  },
  {
    path: '/Attribute/Edit/:id',
    name: 'edit-attribute',
    component: EditAttribute,
    props: true
  }
];