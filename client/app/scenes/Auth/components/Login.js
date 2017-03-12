import React, { PureComponent } from 'react'
import { Link } from 'react-router-dom'
import LoginForm from './LoginForm'

class Login extends PureComponent {
  handleSubmit(values) {
    console.log('give me tha chance to login', values)
  }

  render() {
    return (
      <section className="widget">
        <header>
          <h1>Вход</h1>
        </header>
        <LoginForm onSubmit={this.handleSubmit} />
        <Link to="/register">Регистрация</Link>
      </section>
    )
  }
}

export default Login
