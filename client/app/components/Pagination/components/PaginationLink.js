import React from 'react'
import PropTypes from 'prop-types'
import { NavLink } from 'react-router-dom'

const PaginationLink = ({ url, pageNumber, currentPageNumber }) => {
  if (pageNumber === 1) {
    const isActive = (match) => {
      return match || currentPageNumber === 1
    }

    return <NavLink exact isActive={isActive} to={`${url}`}>{pageNumber}</NavLink>
  }

  return <NavLink exact to={`${url}/page/${pageNumber}`}>{pageNumber}</NavLink>
}

PaginationLink.propTypes = {
  url: PropTypes.string.isRequired,
  pageNumber: PropTypes.number.isRequired,
  currentPageNumber: PropTypes.number.isRequired
}

export default PaginationLink
