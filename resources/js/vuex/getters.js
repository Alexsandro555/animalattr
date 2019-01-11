import { GLOBAL } from "@/constants"

export default {
  [GLOBAL.GET_ITEM]: (state, commit) => (id) => {
    return state.items.find(item => item.id == id)
  }
}