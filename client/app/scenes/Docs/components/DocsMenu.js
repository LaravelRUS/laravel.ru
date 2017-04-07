import React, { Component, PropTypes } from 'react'
import remark from 'remark'
import remarkHtml from 'remark-html'

class DocsMenu extends Component {
  prepareContent() {
    return this.props.contents.replace(/{{version}}/g, '5.4')
  }

  renderMarkup() {
    return {
      __html: remark().use(remarkHtml).processSync(this.prepareContent())
    }
  }

  render() {
    return (
      <section className="menu" dangerouslySetInnerHTML={this.renderMarkup()} />
    )
  }
}

export default DocsMenu
