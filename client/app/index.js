import React from 'react'
import ReactDOM from 'react-dom'
// import { Provider } from 'react-redux'
import { ApolloProvider } from 'react-apollo'
import store from './config/store'
import apolloClient from './config/apollo'
import App from './App'
import './app.scss'

ReactDOM.render(
  <ApolloProvider store={store} client={apolloClient}>
    <App />
  </ApolloProvider>,
  document.getElementById('app')
)
