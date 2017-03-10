import { applyMiddleware, compose, createStore, combineReducers } from 'redux'
import { reducer as formReducer } from 'redux-form'
import thunk from 'redux-thunk'

// eslint-disable-next-line import/no-mutable-exports
export let store

const devTools = (process.env.NODE_ENV === 'development' && window.devToolsExtension)
 ? window.devToolsExtension()
 : f => f

export function configureStore({ reducers, middleware, initialState }) {
  store = createStore(
    combineReducers({
      form: formReducer,
      ...reducers
    }),
    initialState,
    compose(
      applyMiddleware(...[thunk, ...middleware]),
      devTools
    )
  )

  return store
}
