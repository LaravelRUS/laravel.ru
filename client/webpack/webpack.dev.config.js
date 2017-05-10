const fs = require('fs')
const webpack = require('webpack')
const config = require('./config')

module.exports = {
  entry: [
    'babel-regenerator-runtime',
    config.common.appDir
  ],
  output: {
    path: config.common.appDir,
    publicPath: '/',
    filename: 'bundle.js'
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
          'style-loader',
          'css-loader',
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
      config.common.appDir,
      'node_modules'
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': '"development"'
    })
  ],
  devServer: {
    contentBase: `${__dirname}/public`,
    host: '0.0.0.0',
    port: 3000,
    proxy: {
      '/graphql': 'http://0.0.0.0:80'
    },
    historyApiFallback: {
      disableDotRule: true
    },
    noInfo: true,
    stats: 'errors-only',
    overlay: {
      warnings: true,
      errors: true
    }
  }
}
