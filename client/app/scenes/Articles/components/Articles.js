import React, { PropTypes } from 'react'
import { graphql } from 'react-apollo'
import { ArticlesPagePaginatedQuery } from 'api/graphQl/articles'
import ArticlesList from './ArticlesList'

const Articles = ({ data }) => (
  <section className="articles-page">
    <div className="articles-list">
      <ArticlesList data={data} />
    </div>
    <div className="articles-sidebar">
      <p>yolo</p>
    </div>
  </section>
)

Articles.propTypes = {
  data: PropTypes.object.isRequired
}

export default graphql(ArticlesPagePaginatedQuery)(Articles)
