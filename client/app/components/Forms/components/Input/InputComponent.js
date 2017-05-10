import React from 'react'
import PropTypes from 'prop-types'
import { getFieldClassName } from '../../utilities'
import FieldError from '../FieldError'

const InputComponent = ({ input, label, meta, type }) => (
  <div className={getFieldClassName('form-field', meta)}>
    <label htmlFor={input.name}>{label}</label>
    <input type={type} id={input.name} {...input} />
    <FieldError state={meta} />
  </div>
)

InputComponent.propTypes = {
  input: PropTypes.object.isRequired,
  label: PropTypes.string.isRequired,
  type: PropTypes.string.isRequired,
  meta: PropTypes.object.isRequired
}

export default InputComponent
