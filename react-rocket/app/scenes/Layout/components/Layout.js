import React, { PropTypes } from 'react'
import Header from './Header'
import Footer from './Footer'

const Layout = ({ children }) => (
  <section className="laravel-root">
    <Header />
    <main className="laravel-main">
      {children}
    </main>
    <Footer />
  </section>
)

Layout.propTypes = {
  children: PropTypes.node.isRequired
}

export default Layout
