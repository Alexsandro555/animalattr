import { PRIVATE } from "@/constants";

export default {
  [PRIVATE.UPDATE_RELATIONS]: (state, payload) => {
      // при выборе типа продукта у производителя и линейки обновляется список в соответствии с отношениями
      for(let key in payload) {
        if(key === 'line_product') return 1;
        if(state.fields[key].relations) {
          state.fields[key].relations.forEach(relation => {
            relation = relation.substr(0,relation.length-1)
            if(state.fields[relation]) {
              let keyItem = payload[key]
              state.fields[key].items.forEach(item => {
                if(item.id == keyItem) {
                  state.fields[relation].items = item[relation+'s']
                }
              })
            }
          })
        }
      }
    },
    [PRIVATE.SET_ATTRIBUTES]: (state, payload) => {
      state.attributes = payload
    }
}
