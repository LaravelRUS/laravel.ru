const path = require('path')

module.exports = {
  entry: './app',
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'app')
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: 'babel-loader'
      },
      {
        test: /\.scss$/,
        use: [
          { loader: 'style-loader' },
          { loader: 'css-loader' },
          {
            loader: 'postcss-loader',
            options: {
              plugins: () => [
                require('autoprefixer')({
                  browsers: ['last 2 versions']
                })
              ]
            }
          },
          {
            loader: 'sass-loader',
            options: {
              precision: 10
            }
          }
        ]
      }
    ]
  },
  resolve: {
    modules: [
      path.resolve(__dirname, 'app'),
      'node_modules'
    ]
  },
  devServer: {
    contentBase: path.join(__dirname, 'app'),
    historyApiFallback: true,
    host: '0.0.0.0',
    noInfo: true,
    stats: 'errors-only',
    overlay: {
      warnings: true,
      errors: true
    }
  }
}
