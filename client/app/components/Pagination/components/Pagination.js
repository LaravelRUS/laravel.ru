import React, { PropTypes } from 'react'
import PaginationLink from './PaginationLink'

const Pagination = ({ currentPage }) => {
  const numberOfPages = 5

  return (
    <ul className="pagination">
      {[...Array(numberOfPages)].map((x, i) => (
        <li key={i}>
          <PaginationLink url="/articles" pageNumber={i + 1} currentPageNumber={Number(currentPage)} />
        </li>
      ))}
    </ul>
  )
}

Pagination.propTypes = {
  currentPage: PropTypes.oneOfType([
    PropTypes.string,
    PropTypes.number
  ])
}

export default Pagination
