import gql from 'graphql-tag'

export const ArticlesPagePaginatedQuery = gql`
  query articles {
    articles(status: Published, _page: 1, _limit: 15) {
      id
      title
      url
      preview_source
      published_at
      user {
        name
      }
      tags {
        id
        name
      }
    }
  }
`
