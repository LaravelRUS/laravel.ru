import classNames from 'classnames'

export function getFieldClassName(className, { error, touched }, additionalClasses = {}) {
  return classNames(className, {
    ...additionalClasses,
    success: touched && !error,
    error: touched && error
  })
}
