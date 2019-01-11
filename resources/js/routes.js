import ListProduct from '@product/vue/Product/ListProduct'
import EditProduct from '@product/vue/Product/EditProduct'
import ListAttribute from '@product/vue/Attribute/ListAttribute'
import EditAttribute from '@product/vue/Attribute/EditAttribute'
import ListCategory from '@product/vue/Category/ListCategory'
import EditCategory from '@product/vue/Category/EditCategory'

export const routes = [
  {
    path: '/',
    name: 'list-product',
    component: ListProduct
  },
  {
    path: '/product/edit/:id',
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
    path: '/attribute/edit/:id',
    name: 'edit-attribute',
    component: EditAttribute,
    props: true
  },
  {
    path: '/categories/:parentId?',
    name: 'list-categories',
    component: ListCategory,
    props: true
  },
  {
    path: '/categories/edit/:id',
    name: 'edit-category',
    component: EditCategory,
    props: true
  }
];