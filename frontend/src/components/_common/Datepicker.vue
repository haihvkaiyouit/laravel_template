<template>
    <input type="text" ref="datepicker">
</template>

<script>
export default {
  props: [
    'value',
    'options'
  ],
  mounted: function () {
    const vm = this
    $(this.$refs.datepicker).val(this.value)
    $(this.$refs.datepicker).datepicker(this.options).on('change', function (ev, args) {
      vm.$emit('input', $(this).val())
    })
  },
  watch: {
    /* on change value */
    value: function (value, oldValue) {
      const vm = this
      $(this.$refs.datepicker).datepicker('update', value)
      $(this.$refs.datepicker).val(this.value).trigger('change')
      vm.$emit('change', this.value)
    },
    /* on change options */
    options: function (options) {

    }
  },
  methods: {},
  destroyed: function () {
    $(this.$refs.datepicker).datepicker('destroy')
  }
}
</script>
