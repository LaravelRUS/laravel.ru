import React from 'react'
import PropTypes from 'prop-types'
import { Loading } from 'components/Loading'
import { Pagination } from 'components/Pagination'
import ArticlesListItem from './ArticlesListItem'

const ArticlesList = ({ data: { articles, error, loading, paginator }, match }) => {
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
      <Pagination
        url="/articles"
        totalPages={paginator.pages_count}
        currentPage={Number(match.params.id) || 1}
      />
    </section>
  )
}

ArticlesList.propTypes = {
  data: PropTypes.object.isRequired,
  match: PropTypes.object.isRequired
}

export default ArticlesList
