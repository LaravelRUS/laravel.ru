import React from 'react'
import { BrowserRouter, Route, Link, Switch } from 'react-router-dom'
import { Articles } from 'scenes/Articles'
import { Docs } from 'scenes/Docs'
import { Home } from 'scenes/Home'
import { NotFound } from 'scenes/NotFound'

const App = () => (
  <BrowserRouter>
    <div className="app-root">
      <header>
        <ul>
          <li><Link to="/">Home</Link></li>
          <li><Link to="/docs">Docs</Link></li>
          <li><Link to="/articles">Articles</Link></li>
        </ul>
      </header>
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
