import React, { PropTypes } from 'react'
import { Loading } from 'components/Loading'
import ArticlesListItem from './ArticlesListItem'

const ArticlesList = ({ data: { articles, error, loading } }) => {
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
    <ul>
      {articles.map(article => (
        <ArticlesListItem key={article.id} article={article} />
      ))}
    </ul>
  )
}

ArticlesList.propTypes = {
  data: PropTypes.object.isRequired
}

export default ArticlesList
