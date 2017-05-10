import React, { Component } from 'react'
import remark from 'remark'
import remarkHtml from 'remark-html'

class DocsContents extends Component {
  renderMarkup() {
    return {
      __html: remark().use(remarkHtml).processSync(this.props.contents)
    }
  }

  render() {
    return (
      <section className="contents" dangerouslySetInnerHTML={this.renderMarkup()} />
    )
  }
}

export default DocsContents
