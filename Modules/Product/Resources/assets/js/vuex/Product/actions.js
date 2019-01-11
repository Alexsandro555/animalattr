import { ACTIONS } from "@product/constants"
import { PRIVATE, GLOBAL } from "@/constants"
import { api } from "@product/api/Product"

export default {
  [ACTIONS.UPDATE_RELATIONS]: ({commit, store},data) => {
    let obj = {'type_product': data}
    commit(PRIVATE.UPDATE_RELATIONS,obj)
  },
  [ACTIONS.UPDATE_FIELD]: ({ commit }, objField) => {
    //commit('SET_ITEM',objField)
    commit(PRIVATE.UPDATE_RELATIONS, objField)
  },
  [ACTIONS.ATTRIBUTES]: ({ commit }, id) => {
    api.getAttributes(id)
      .then(response => {
        commit(PRIVATE.SET_ATTRIBUTES,response)
      })
  }
}