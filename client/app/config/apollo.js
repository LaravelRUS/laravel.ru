import ApolloClient, { createNetworkInterface } from 'apollo-client'

export default new ApolloClient({
  networkInterface: createNetworkInterface({
    uri: 'http://127.0.0.1:8000/graphql'
  })
})
