import axios from "axios/index"

export const api = {
    url: '/product',
    patch(data) {
        return new Promise((resolve, reject) => {
            axios.patch(this.url, data).then(response => response.data).then(response => {
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    getAttributes(id) {
        return new Promise((resolve, reject) => {
          axios.get(this.url+'/attributes/'+id).then(response => response.data).then(response => {
            let attributes = []
              let productAttributes = response.attributes
              const productAttributeValues = response.values
              productAttributes.forEach(productAttribute => {
                productAttribute.state = {}
                if(!_.isNull(productAttributeValues[productAttribute.type.title])) {
                  productAttributeValues[productAttribute.type.title].forEach(productAttributeValue => {
                    if(productAttributeValue.id == productAttribute.id) {
                      productAttribute.state = productAttributeValue.pivot
                    }
                  })
                }
              })
              resolve(productAttributes)
          }).catch(error => {
            reject(error)
          })
        })
    },
}