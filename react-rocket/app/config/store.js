import { configureStore } from 'modules/store'
import apolloClient from './apollo'

const reducers = {
  apollo: apolloClient.reducer()
}

const middleware = [
  apolloClient.middleware()
]

const store = configureStore({ reducers, middleware })

export default store
