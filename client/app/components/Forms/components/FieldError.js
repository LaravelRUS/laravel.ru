import React from 'react'
import PropTypes from 'prop-types'

const FieldError = ({ state: { error, touched } }) => (
  touched && error
  ? <p className="error">{error}</p>
  : null
)

FieldError.propTypes = {
  state: PropTypes.object.isRequired
}

export default FieldError
