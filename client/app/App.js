import React from 'react'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import { ApolloProvider } from 'react-apollo'
import store from 'config/store'
import apolloClient from 'config/apollo'
import { Layout } from 'scenes/Layout'
import { Home } from 'scenes/Home'
import { Login, Register } from 'scenes/Auth'
import { Docs } from 'scenes/Docs'
import { Articles } from 'scenes/Articles'
import { NotFound } from 'scenes/NotFound'

const routerBaseName = process.env.NODE_ENV === 'production' ? '/react' : ''

const DocsRoutes = ({ match }) => {
  return (
    <Switch>
      <Route exact path={match.path} component={Docs} />
      <Route exact path={`${match.path}/:slug`} component={Docs} />
      <Route exact path={`${match.path}/:version/:slug`} component={Docs} />
      <Route exact path={`${match.path}/:project/:version/:slug`} component={Docs} />
      <Route component={NotFound} />
    </Switch>
  )
}

const App = () => (
  <ApolloProvider store={store} client={apolloClient}>
    <BrowserRouter basename={routerBaseName}>
      <Layout>
        <Switch>
          <Route exact path="/" component={Home} />
          <Route exact path="/login" component={Login} />
          <Route exact path="/register" component={Register} />
          <Route path="/docs" component={DocsRoutes} />
          <Route exact path="/articles" component={Articles} />
          <Route exact path="/articles/page/:id" component={Articles} />
          <Route component={NotFound} />
        </Switch>
      </Layout>
    </BrowserRouter>
  </ApolloProvider>
)

export default App
