import React, { PropTypes } from 'react'
import { reduxForm } from 'redux-form'
import { Input } from 'components/Forms'
import { Button } from 'components/Buttons'

const LoginForm = ({ handleSubmit }) => (
  <form onSubmit={handleSubmit}>
    <Input label="Электронная почта" name="email" />
    <Input type="password" label="Пароль" name="password" />
    <Button type="submit">Войти</Button>
  </form>
)

LoginForm.propTypes = {
  handleSubmit: PropTypes.func.isRequired
}

export default reduxForm({
  form: 'loginForm'
})(LoginForm)
