import {Loading, QSpinnerGears} from 'quasar'
import axios from 'axios'
import _ from 'lodash'

export default {
  api: async function (options = {}) {
    Loading.show({
      spinner: QSpinnerGears
    })
    try {
      const response = await axios(_.merge({
        headers: {
          'Access-Control-Allow-Origin': '*'
        },
        baseURL: this.$c.API.BASE_URL_API,
        withCredentials: true,
        timeout: 3000,
        method: this.$c.API.METHOD.GET
      }, options))
      Loading.hide()
      return response.data
    } catch (error) {
      console.log(error)
      return false
    }
  },

  getApi: async function (url, params, options = {}) {
    return this.api(_.merge({
      method: this.$c.API.METHOD.GET,
      url,
      params
    }, options))
  },

  postApi: async function (url, data, options = {}) {
    return this.api(_.merge({
      method: this.$c.API.METHOD.POST,
      url,
      data
    }, options))
  },

  putApi: async function (url, data, options = {}) {
    return this.api(_.merge({
      method: this.$c.API.METHOD.PUT,
      url,
      data,
    }, options))
  },

  deleteApi: async function (url, data, options = {}) {
    return this.api(_.merge({
      method: this.$c.API.METHOD.DELETE,
      url,
      data,
    }, options))
  },
}
