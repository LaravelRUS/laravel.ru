import React, { PureComponent } from 'react'
import { Link } from 'react-router-dom'
import RegisterForm from './RegisterForm'

class Register extends PureComponent {
  handleSubmit(values) {
    console.log('give me tha chance to register', values)
  }

  render() {
    return (
      <section className="widget">
        <header>
          <h1>Регистрация</h1>
        </header>
        <RegisterForm onSubmit={this.handleSubmit} />
        <Link to="/login">Войти</Link>
      </section>
    )
  }
}

export default Register
