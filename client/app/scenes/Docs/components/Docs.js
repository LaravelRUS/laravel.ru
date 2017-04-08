import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { graphql } from 'react-apollo'
import { docsPage } from 'api/graphQl/docs'
// import ArticlesList from './ArticlesList'
import { Link } from 'react-router-dom'
import DocsMenu from './DocsMenu'
import DocsContents from './DocsContents'

class Docs extends Component {
  render() {
    const { data: { loading, error, docs } } = this.props

    if (loading) {
      return <p>loading</p>
    }

    if (!loading && error) {
      return <p>error</p>
    }

    if (!loading && (!docs[0].menu[0] || !docs[0].contents[0])) {
      console.log(docs[0])
      return <p>no docs</p>
    }
    console.log(docs[0])

    return (
      <section className="docs-page">
        <DocsMenu contents={docs[0].menu[0].content_source} />
        <DocsContents contents={docs[0].contents[0].content_source} />
      </section>
    )
  }
}

Docs.propTypes = {
  data: PropTypes.object.isRequired
}

export default graphql(docsPage, {
  options(props) {
    const { match: { params: { project, version, slug } } } = props

    return {
      variables: {
        project: project || 'laravel',
        version: version || 'latest',
        page: slug || 'installation'
      }
    }
  }
})(Docs)
