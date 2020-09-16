import AdminRoutes from './admin'

export default [
  ...AdminRoutes,
  {
    path: '*',
    component: () => import('pages/errors/E404')
  }
]
