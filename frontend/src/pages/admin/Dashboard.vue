<template>
  <q-page class="flex flex-center">
    {{$t('admin.dashboard')}}
    <ValidationObserver v-slot="{ passes }">
        <ValidationProvider name="XXX" rules="required|min:10" v-slot="{ errors, invalid }">
          <q-input
            filled
            v-model="test"
            label="Filled"
            :error="invalid"
            :error-message="errors[0]"
          />
        </ValidationProvider>
    </ValidationObserver>
    <img
      alt="Quasar logo"
      src="~assets/quasar-logo-full.svg"
    >
  </q-page>
</template>

<script>
export default {
  data: function (){
    return {
      test: 1,
    }
  },
  created () {
    this.api({
      method: this.$c.API.METHOD.GET,
      baseURL: 'https://jsonplaceholder.typicode.com/todos/1'
    })
  }
}
</script>
