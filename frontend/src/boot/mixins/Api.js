import { Loading, QSpinnerGears } from 'quasar'
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
  }
}
