import React, { PureComponent } from 'react'
import { Link } from 'react-router-dom'
import RegisterForm from './RegisterForm'

class Register extends PureComponent {
  handleSubmit(values) {
    console.log('give me tha chance to register', values)
  }

  render() {
    return (
      <section className="register-page">
        <header>
          <h1>Регистрация</h1>
        </header>
        <RegisterForm onSubmit={this.handleSubmit} />
        <p>Есть аккаунт? <Link to="/login">Войти</Link></p>
      </section>
    )
  }
}

export default Register
