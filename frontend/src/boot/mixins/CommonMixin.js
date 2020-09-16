export default {
  serialize: function (obj) {
    var str = []
    for (const p in obj) {
      if (obj.prototype.hasOwnProperty(p)) {
        str.push(encodeURIComponent(p) + '=' + encodeURIComponent(obj[p]))
      }
    }

    return str.length > 0 ? '?' + str.join('&') : ''
  },
  getCurrentUser: function () {
    const app = this

    return app.$auth.user
  },
  formatPrice (value) {
    const val = (value / 1).toFixed(2).replace('.', ',')

    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')
  },
  urlEncode: function (obj, prefix) {
    var str = [],
      p
    for (p in obj) {
      if (obj.prototype.hasOwnProperty(p)) {
        var k = prefix ? prefix + '[' + p + ']' : p,
          v = obj[p]
        str.push((v !== null && typeof v === 'object')
          ? this.urlEncode(v, k)
          : encodeURIComponent(k) + '=' + encodeURIComponent(v))
      }
    }
    return str.join('&')
  }

}
