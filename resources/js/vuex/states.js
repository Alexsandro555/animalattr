import * as actions from './actions'
import mutations from './mutations'
import getters from './getters'
import initializer from '@initializer/vuex/initializer/state'
import Product from '@product/vuex/Product/state'
import notification from '@/vuex/notification/state'
import Attribute from '@product/vuex/Attribute/state'
import Category from '@product/vuex/Category/state'

export default function() {
  return {
    modules: {
      initializer,
      notification,
      Product,
      Attribute,
      Category
    },
    mutations,
    getters
  }
}