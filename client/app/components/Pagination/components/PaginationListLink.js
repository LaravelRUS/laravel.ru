import React from 'react'
import PropTypes from 'prop-types'
import { NavLink } from 'react-router-dom'

const PaginationListLink = ({ currentPageNumber, pageLabel, pageNumber, url, ...rest }) => {
  const pageTitle = pageLabel || pageNumber
  const isActive = match => (pageNumber === 1) ? (match || currentPageNumber === 1) : match
  const pageUrl = (pageNumber === 1) ? url : `${url}/page/${pageNumber}`

  return <li {...rest}><NavLink exact isActive={isActive} to={pageUrl}>{pageTitle}</NavLink></li>
}

PaginationListLink.propTypes = {
  url: PropTypes.string.isRequired,
  pageLabel: PropTypes.string,
  pageNumber: PropTypes.number.isRequired,
  currentPageNumber: PropTypes.number.isRequired
}

export default PaginationListLink
