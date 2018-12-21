import ListProduct from '@product/vue/Product/ListProduct'
import EditProduct from '@product/vue/Product/EditProduct'

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
  }
];