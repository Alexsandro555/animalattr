export default {
    namespaced: true,
    state: {
        messages: {}
    },
    actions: {
        init({ commit, dispatch }) {
            axios.interceptors.response.use(response => {
                    return response;
                },
                error => {
                    let errorType = error.response.status
                    if(errorType == 419) {
                        setTimeout(() => {document.location.href = '/'},2000)
                    }
                    if(errorType == 422) {
                        commit('SET_ERRORS', error.response.data.errors)
                    }
                    else {
                      dispatch('errorNotification', error.response.data.message, {root: true})
                    }
                    return Promise.reject(error.response);
                })
        },
        resetError({commit}) {
            commit('RESET_ERROR')
        }
    },
    getters: {},
    mutations: {
        SET_ERRORS: (state, payload) => {
            state.messages = Object.assign({}, payload)
        },
        RESET_ERROR: (state) => {
            state.messages = {}
        }
    }
}