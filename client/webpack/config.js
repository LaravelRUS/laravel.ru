const path = require('path')

module.exports = {
  common: {
    appDir: path.resolve(__dirname, '../app')
  },
  prod: {
    output: {
      js: {
        path: path.resolve(__dirname, '../../server/public/dist'),
        filename: 'react.js'
      },
      css: {
        filename: 'react.css'
      }
    }
  }
}
