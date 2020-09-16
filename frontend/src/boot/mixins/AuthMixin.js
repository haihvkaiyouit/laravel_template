export default {
  logout: function () {
    const app = this
    app.$auth.logout({
      makeRequest: true,
      params: {},
      success: function () {
        window.location = '/login'
        console.log('logout success')
      },
      error: function () {
        console.log('logout error')
      },
      redirect: false
    })
  }
}
