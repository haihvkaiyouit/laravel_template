export default [
  {
    path: '/admin',
    component: () => import('../../pages/admin/_layouts/Layout'),
    children: [
      { path: '/', component: () => import('../../pages/admin/Dashboard') },
      { path: '/login', component: () => import('../../pages/admin/Dashboard') }
    ]
  }
]
