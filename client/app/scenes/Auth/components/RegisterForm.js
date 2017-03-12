import React, { PropTypes } from 'react'
import { reduxForm } from 'redux-form'
import { Input } from 'components/Forms'
import { Button } from 'components/Buttons'

const RegisterForm = ({ handleSubmit }) => (
  <form onSubmit={handleSubmit}>
    <Input label="Имя пользователя" name="username" />
    <Input type="email" label="Электронная почта" name="email" />
    <Input type="password" label="Пароль" name="password" />
    <Button type="submit">Зарегистрироваться</Button>
  </form>
)

RegisterForm.propTypes = {
  handleSubmit: PropTypes.func.isRequired
}

export default reduxForm({
  form: 'registerForm'
})(RegisterForm)
