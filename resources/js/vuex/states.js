import * as actions from './actions'
import mutations from './mutations'
import initializer from '@initializer/vuex/initializer/state'
import Product from '@product/vuex/Product/state'
import notification from '@/vuex/notification/state'

export default function() {
  return {
    modules: {
      initializer,
      Product,
      notification
    },
    mutations
  }
}