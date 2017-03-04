import React from 'react'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import { Articles, Docs, Home, Layout, Login, NotFound, Register } from 'scenes'

const routerBaseName = process.env.NODE_ENV === 'production' ? '/test-react' : ''

const App = () => (
  <BrowserRouter basename={routerBaseName}>
    <Layout>
      <Switch>
        <Route exact path="/" component={Home} />
        <Route exact path="/login" component={Login} />
        <Route exact path="/register" component={Register} />
        <Route path="/docs" component={Docs} />
        <Route path="/articles" component={Articles} />
        <Route component={NotFound} />
      </Switch>
    </Layout>
  </BrowserRouter>
)

export default App
