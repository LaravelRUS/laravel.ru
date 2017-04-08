import React from 'react'
import PropTypes from 'prop-types'
import Header from './Header'
import Footer from './Footer'

const Layout = ({ children }) => (
  <section className="laravel">
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
