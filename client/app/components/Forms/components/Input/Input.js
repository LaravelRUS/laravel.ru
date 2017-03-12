import React, { PropTypes, PureComponent } from 'react'
import { Field } from 'redux-form'
import InputComponent from './InputComponent'

class Input extends PureComponent {
  handleFocus(e) {
    e.preventDefault()
  }

  render() {
    const { label, name, type, ...rest } = this.props

    return (
      <Field
        type={type}
        name={name}
        label={label}
        component={InputComponent}
        onFocus={this.handleFocus}
        {...rest}
      />
    )
  }
}

Input.propTypes = {
  label: PropTypes.string.isRequired,
  name: PropTypes.string.isRequired,
  type: PropTypes.string.isRequired
}

Input.defaultProps = {
  type: 'text'
}

export default Input
