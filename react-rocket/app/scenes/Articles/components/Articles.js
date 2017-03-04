import React from 'react'
import { Loading } from 'components/Loading'
import { graphql } from 'react-apollo'
import gql from 'graphql-tag'

const Articles = (props) => {
  if (props.data.loading) {
    return <Loading />
  }

  return (
    <div>
      {props.data.articles && (
        <ul>
          {props.data.articles.map(article => (
            <li key={article.id}>{article.title}</li>
          ))}
        </ul>
      )}
    </div>
  )
}


const CurrentUserForLayout = gql`
  query CurrentUserForLayout {
    articles {
      id
      title
      url
      image
      content
      content_source
      preview
      preview_source
      status
      user {
        name
        avatar
      }
      tags {
        name
        color
      }
    }
  }
`

export default graphql(CurrentUserForLayout)(Articles)
