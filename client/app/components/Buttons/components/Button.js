import React, { PropTypes } from 'react'

const Button = ({ children, ...rest }) => (
  <button className="button" {...rest}>{children}</button>
)

Button.propTypes = {
  children: PropTypes.node.isRequired
}

export default Button
