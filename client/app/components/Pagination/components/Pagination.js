import React, { Component } from 'react'
import PropTypes from 'prop-types'
import PaginationListLink from './PaginationListLink'

class Pagination extends Component {
  rangeStartPage() {
    const page = this.props.currentPage - this.props.pageRange

    return page > 0 ? page : 1
  }

  rangeEndPage() {
    const page = this.props.currentPage + this.props.pageRange

    return page < this.props.totalPages ? page : this.props.totalPages
  }

  visiblePages() {
    const pages = []

    for (let i = this.rangeStartPage(); i <= this.rangeEndPage(); i += 1) {
      pages.push(i)
    }

    return pages
  }

  renderListLink(props) {
    const { currentPage, url } = this.props

    return <PaginationListLink url={url} currentPageNumber={currentPage} {...props} />
  }

  renderPreviousLink() {
    return (this.props.currentPage > 1)
    ? this.renderListLink({
      className: 'pagination-label',
      pageNumber: (this.props.currentPage - 1),
      pageLabel: 'Предыдущая'
    })
    : null
  }

  renderNextLink() {
    return (this.props.currentPage < this.props.totalPages)
    ? this.renderListLink({
      className: 'pagination-label',
      pageNumber: (this.props.currentPage + 1),
      pageLabel: 'Следующая'
    })
    : null
  }

  renderFirstLink() {
    return (this.rangeStartPage() > 1)
    ? this.renderListLink({ pageNumber: 1 })
    : null
  }

  renderLastLink() {
    return (this.rangeEndPage() < this.props.totalPages)
    ? this.renderListLink({ pageNumber: this.props.totalPages })
    : null
  }

  renderVisiblePages() {
    return this.visiblePages().map(value => this.renderListLink({ key: value, pageNumber: value }))
  }

  render() {
    if (this.props.totalPages > 1) {
      return (
        <ul className="pagination">
          {this.renderPreviousLink()}
          {this.renderFirstLink()}
          {this.renderVisiblePages()}
          {this.renderLastLink()}
          {this.renderNextLink()}
        </ul>
      )
    }

    return null
  }
}

Pagination.propTypes = {
  currentPage: PropTypes.number.isRequired,
  pageRange: PropTypes.number.isRequired,
  totalPages: PropTypes.number.isRequired,
  url: PropTypes.string.isRequired
}

Pagination.defaultProps = {
  pageRange: 2
}

export default Pagination
