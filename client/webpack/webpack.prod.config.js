const path = require('path')
const webpack = require('webpack')
const config = require('./config.json')

module.exports = {
    devtool: 'hidden-source-map',
    entry: path.resolve(__dirname, '../app'),
    output: {
        path: config.build.path,
        filename: config.build.file
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
            path.resolve(__dirname, '../app'),
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
