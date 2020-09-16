<template>
    <input type="text" ref="datetimepicker">
</template>

<script>
export default {
  props: [
    'value',
    'options'
  ],
  mounted: function () {
    const vm = this
    $(this.$refs.datetimepicker).val(this.value)
    $(this.$refs.datetimepicker).datetimepicker(this.options).on('dp.change', function (ev, args) {
      vm.$emit('input', $(this).val())
    })
  },
  watch: {
    /* on change value */
    value: function (value, oldValue) {
      const vm = this
      $(this.$refs.datetimepicker).val(this.value).trigger('dp.change')
      vm.$emit('change', this.value)
    },
    /* on change options */
    options: function (options) {

    }
  },
  methods: {},
  destroyed: function () {
    $(this.$refs.datetimepicker).datetimepicker('destroy')
  }
}
</script>
