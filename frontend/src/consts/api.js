import env from '../env'

export default {
  BASE_URL_API: env.BASE_URL_API,
  METHOD: {
    GET: 'GET',
    POST: 'POST',
    PUT: 'PUT',
    DELETE: 'DELETE'
  },
  HTTP_CODES: {
    SUCCESS: '200',
    CREATED: '201',
    ERROR_VALIDATION: '422'
  }
}
