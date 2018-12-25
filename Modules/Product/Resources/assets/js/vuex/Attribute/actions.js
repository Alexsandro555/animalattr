import { ACTIONS, PRIVATE, GLOBAL } from "@/constants";
import { api } from "@product/api/Attribute";

export default {
  [ACTIONS.UPDATE_FIELD]: ({ commit }, objField) => {
    commit('SET_ITEM',objField)
  },
}