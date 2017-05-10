import gql from 'graphql-tag'

export const articlesPaginated = gql`
  query articlesPaginated($page: Int, $limit: Int) {
    articles(_page: $page, _limit: $limit) {
      id
      title
      image
      slug
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
    paginator(query: "articles") {
      pages_count
    }
  }
`
