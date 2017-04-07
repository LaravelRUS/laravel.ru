import React, { PureComponent } from 'react'
import { Link } from 'react-router-dom'
import { withApollo } from 'react-apollo'
import { login } from 'api/graphQL/auth'
import LoginForm from './LoginForm'

class Login extends PureComponent {
  state = {
    loading: false
  }

  handleSubmit = async (values) => {
    this.setState({ loading: true })

    try {
      const result = await this.props.client.query({
        query: login,
        variables: {
          email: values.email,
          password: values.password
        }
      })

      // console.log(result.data.auth.name)
      // console.log(result.data.auth.token)
    } catch (e) {
      // console.log(e)
    } finally {
      this.setState({ loading: false })
    }

  }

  render() {
    // console.log(m)
    return (
      <section className="login">
        <header>
          <h1>Вход</h1>
        </header>
        <p>{this.state.loading ? 1 : 2}</p>
        <LoginForm onSubmit={this.handleSubmit} />
        <Link to="/register">Регистрация</Link>
      </section>
    )
  }
}

export default withApollo(Login)
