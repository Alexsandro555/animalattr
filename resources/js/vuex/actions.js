import {PRIVATE, GLOBAL} from '@/constants.js'
import { api } from '@/api/main.js'

export default {
  [GLOBAL.INITIALIZATION] : ({dispatch, commit}, id) => {
    dispatch(GLOBAL.SET_FIELDS)
    commit('SELECT_VARIABLE_BY_ID', {source: 'items', receiver: 'item', id})
  },
  [GLOBAL.SET_FIELDS] : ({ commit, state }) => {
    return new Promise((resolve, reject) => {
      api.get('/initializer/fields/'+state.name).then(response => {
        commit('SET_ARRAY_VARIABLE', {variable: 'fields', value: response})
        resolve()
      }).catch(error => {
        reject(error)
      })
    })
  },
  [GLOBAL.UPDATE_ITEM]: ({commit}, objField) => {
    commit(PRIVATE.SET_ITEM,objField)
  },
  [GLOBAL.LOAD]: ({commit, state}) => {
    return new Promise((resolve, reject) => {
      api.get(state.url).then(response => {
        commit('SET_ARRAY_VARIABLE', {variable: 'items', value: response})
        resolve()
      }).catch(error => {
        reject(error)
      })
    })
  },
  [GLOBAL.DELETE]: ({ commit, state }, id) => {
    api.delete({url: state.url, id})
      .then(response => {
        commit(PRIVATE.DELETE, response)
      })
  },
  [GLOBAL.ADD]: ({ commit, state }) => {
    return new Promise((resolve, reject) => {
      api.create(state.url).then(response => {
        commit(PRIVATE.ADD, response)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  }
}