import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'

const ArticlesListItem = ({ article }) => {
  // console.log(article)

  return (
    <li>
      <article>
        {/* <ul>
          {article.tags.map(tag => (
            <li key={tag.id}>{tag.name}</li>
          ))}
        </ul> */}
        {/* <img src={article.image} alt={article.title} /> */}
        <img src={`https://unsplash.it/1340/840/?random&y=${article.id}`} alt={article.title} />
        <div className="contents">
          <header>
            <h3>{article.title}</h3>
          </header>
          <div className="preview">{article.preview_source}</div>
          <footer>
            <Link to="/">Подробнее</Link>
          </footer>
        </div>
      </article>
    </li>
  )
}

ArticlesListItem.propTypes = {
  article: PropTypes.object.isRequired
}

export default ArticlesListItem
