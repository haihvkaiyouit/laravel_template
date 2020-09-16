<template>
    <select ref='select'>
        <slot></slot>
    </select>
</template>

<script>
import Vue from 'vue'
export default {
  props: [
    'options',
    'value'
  ],
  mounted: function () {
    const vm = this
    $(this.$refs.select).val(this.value)
    $(this.$refs.select)
      .select2(this.options)
      .on('change', function (ev, args) {
        if (!(args && 'ignore' in args)) {
          vm.$emit('input', $(this).val())
        }
      })
    Vue.nextTick(() => {})
  },
  watch: {
    /* on change value */
    value: function (value, oldValue) {
      const vm = this
      $(this.$refs.select)
        .val(this.value)
        .trigger('change', { ignore: true })
      vm.$emit('change', this.value)
    },
    /* on change options */
    options: function (options) {
      $(this.$refs.select).select2(options)
    }
  },
  destroyed: function () {
    $(this.$refs.select).off().select2('destroy')
  }
}
</script>
