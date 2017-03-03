import React from 'react'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import { Articles } from 'scenes/Articles'
import { Docs } from 'scenes/Docs'
import { Home } from 'scenes/Home'
import { NotFound } from 'scenes/NotFound'
import Header from 'scenes/Layout/components/Header'

const App = () => (
  <BrowserRouter>
    <div className="app-root">
      <Switch>
        <Route exact path="/" render={() => <Header />} />
        <Route path="/docs" render={() => <Header />} />
        <Route path="/articles" component={() => <Header />} />
      </Switch>
      <main>
        <Switch>
          <Route exact path="/" component={Home} />
          <Route path="/docs" component={Docs} />
          <Route path="/articles" component={Articles} />
          <Route component={NotFound} />
        </Switch>
      </main>
    </div>
  </BrowserRouter>
)

export default App
