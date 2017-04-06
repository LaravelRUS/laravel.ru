const webpack = require('webpack')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const CopyWebpackPlugin = require('copy-webpack-plugin')
const config = require('./config')

module.exports = {
  devtool: 'hidden-source-map',
  entry: config.common.appDir,
  output: {
    path: config.prod.output.js.path,
    filename: config.prod.output.js.filename
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
        use: ExtractTextPlugin.extract({
          use: [
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
        })
      }
    ]
  },
  resolve: {
    modules: [
      config.common.appDir,
      'node_modules'
    ],
    mainFields: [
      'browser',
      'module',
      'jsnext:main',
      'main'
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': '"production"'
    }),
    new ExtractTextPlugin(config.prod.output.css.filename),
    new CopyWebpackPlugin([{
      from: `${__dirname}/public/fonts`,
      to: 'fonts'
    }]),
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        screw_ie8: true,
        warnings: false
      },
      output: {
        comments: false
      },
      sourceMap: false
    })
  ]
}
