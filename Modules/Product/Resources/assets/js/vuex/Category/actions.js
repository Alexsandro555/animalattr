import {PRIVATE, GLOBAL} from "@/constants";
import {ACTIONS} from "@product/constants";
import {api} from "@product/api/Category";

export default {
  [ACTIONS.LOAD]: ({commit, store}, parentId = "") => {
    return new Promise((resolve, reject) => {
      api.get(parentId).then(response => {
        commit('SET_ARRAY_VARIABLE', {variable: 'items', value: response})
        resolve()
      }).catch(error => {
        reject(error)
      })
    })
  },
  [ACTIONS.ADD]: ({commit, store}, parentId = null) => {
    return new Promise((resolve, reject) => {
      api.post(parentId).then(response => {
        commit('SET_VARIABLE', {variable: 'item', value: response})
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  }
}