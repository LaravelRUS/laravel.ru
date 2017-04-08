import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { graphql } from 'react-apollo'
import { articlesPaginated } from 'api/graphQl/articles'
import ArticlesList from './ArticlesList'

class Articles extends Component {
  render() {
    const { data, match } = this.props

    return (
      <section className="articles-page">
        <section className="main">
          <ArticlesList match={match} data={data} />
        </section>
        <div className="sidebar">
          <p>yolo</p>
        </div>
      </section>
    )
  }
}

Articles.propTypes = {
  data: PropTypes.object.isRequired,
  match: PropTypes.object.isRequired
}

export default graphql(articlesPaginated, {
  options(props) {
    const page = props.match.params.id || 1

    return {
      variables: {
        page,
        limit: 10
      }
    }
  }
})(Articles)
