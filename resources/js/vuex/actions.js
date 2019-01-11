import {PRIVATE, GLOBAL} from '@/constants.js'
import { api } from '@/api/main.js'

export default {
  [GLOBAL.INITIALIZATION] : ({ state, dispatch, commit }) => {
    return new Promise((resolve, reject) => {
      api.get('/initializer/fields/'+state.name).then(response => {
        commit('SET_ARRAY_VARIABLE', {variable: 'fields', value: response})
        resolve()
      }).catch(error => {
        reject(error)
      })
    })
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
  [GLOBAL.ADD]: ({ commit, state }) => {
    return new Promise((resolve, reject) => {
      api.create(state.url).then(response => {
        commit(PRIVATE.ADD, response)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  [GLOBAL.UPDATE_ITEM]: ({commit}, objField) => {
    commit('SET_VARIABLE',{module: ''})
  },
  [GLOBAL.DELETE]: ({ commit, state }, id) => {
    api.delete({url: state.url, id})
      .then(response => {
        commit(PRIVATE.DELETE, response)
      })
  },
  [GLOBAL.SAVE_DATA]: ({ commit, dispatch, state }, data) => {
    return new Promise((resolve, reject) => {
      api.patch({data, url: state.url})
        .then(response => {
          dispatch('successSaveNotification', response.message, {root: true})
          commit(GLOBAL.UPDATE, response)
          resolve()
        }).catch(error => {
        reject(error)
      })
    })
  }
}