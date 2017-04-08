import React from 'react'
import PropTypes from 'prop-types'
import { Loading } from 'components/Loading'
import { Pagination } from 'components/Pagination'
import ArticlesListItem from './ArticlesListItem'

const ArticlesList = ({ data: { articles, error, loading }, match }) => {
  if (loading) {
    return <Loading />
  }

  if (!loading && error) {
    return <p>error</p>
  }

  if (!loading && !articles.length) {
    return <p>no articles</p>
  }

  return (
    <section className="articles">
      <ul className="articles-list">
        {articles.map(article => (
          <ArticlesListItem key={article.id} article={article} />
        ))}
      </ul>
      <Pagination currentPage={match.params.id} />
    </section>
  )
}

ArticlesList.propTypes = {
  data: PropTypes.object.isRequired,
  match: PropTypes.object.isRequired
}

export default ArticlesList
