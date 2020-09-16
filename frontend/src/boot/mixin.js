// import something here
import AuthMixin from './mixins/AuthMixin'
import CommonMixin from './mixins/CommonMixin'
import ApiMixin from './mixins/Api'

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/cli-documentation/boot-files#Anatomy-of-a-boot-file
export default async ({ Vue }) => {
  Vue.mixin({
    methods: { ...AuthMixin, ...CommonMixin, ...ApiMixin }
  })
}
