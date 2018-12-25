import axios from "axios/index"

export const api = {
  get(url) {
    return new Promise((resolve, reject) => {
      axios.get(url).then(response => response.data).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  patch(data) {
    return new Promise((resolve, reject) => {
      console.log(this.url)
      axios.patch(this.url, data).then(response => response.data).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  delete({url, id}) {
    return new Promise((resolve, reject) => {
      axios.delete(url, {params: {id}}).then(response => response.data).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  create(url) {
    return new Promise((resolve, reject) => {
      axios.post(url).then(response => response.data).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      });
    })
  }
}