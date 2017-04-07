import gql from 'graphql-tag'

export const docsPage = gql`
  query docsPage($project: String!, $version: String!, $page: String!) {
    docs(project: $project, version: $version) {
      title
      description
      menu: pages(slug: "documentation") {
        title
        content_source
      }
      contents: pages(slug: $page) {
        title
        content_source
      }
    }
  }
`
