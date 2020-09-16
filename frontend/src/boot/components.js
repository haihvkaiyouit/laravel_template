import Paginate from 'vuejs-paginate'
import { ValidationObserver, ValidationProvider } from 'vee-validate'

import SelectComponent from '../components/_common/Select'
import DatepickerComponent from '../components/_common/Datepicker'
import DateTimePickerComponent from '../components/_common/DateTimePicker'

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/cli-documentation/boot-files#Anatomy-of-a-boot-file
export default async ({ Vue }) => {
  Vue.component('paginate', Paginate)
  Vue.component('SelectComponent', SelectComponent)
  Vue.component('ValidationProvider', ValidationProvider)
  Vue.component('ValidationObserver', ValidationObserver)
  Vue.component('DatepickerComponent', DatepickerComponent)
  Vue.component('DateTimePickerComponent', DateTimePickerComponent)
}
