// import something here
import i18n from '../lang/i18n'
import VueCookies from 'vue-cookies'
import { localize } from 'vee-validate'
import consts from '../consts'
import './vee-validate'
// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/cli-documentation/boot-files#Anatomy-of-a-boot-file

export default async ({ app, router, Vue }) => {
  app.i18n = i18n
  app.$cookies = VueCookies
  app.$localize = localize
  Vue.prototype.$c = consts
  Vue.use(VueCookies)
  Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
  })

  router.beforeEach((to, from, next) => {
    let language = app.$cookies.get(consts.APP.APP_NAME + 'lang-cookie')
    if (!language) {
      app.$cookies.set(consts.APP.APP_NAME + 'lang-cookie', 'ja')
      language = 'ja'
    }

    app.$localize(language)
    app.i18n.locale = language
    next()
  })
}
