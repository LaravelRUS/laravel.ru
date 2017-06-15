const path = require('path');
const webpack = require('webpack');
const ident = require('css-loader/lib/getLocalIdent');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

// Config
module.exports = {
    entry: './resources/js/bootstrap',
    devtool: 'source-map',
    output: {
        path: `${__dirname}/public/dist/`,
        filename: 'app.js'
    },
    resolve: {
        modules: [
            'resources/js',
            'resources/css',
            'node_modules'
        ]
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                include: [
                    path.resolve(__dirname, './resources/'),
                    path.resolve(__dirname, './node_modules/dioma'),
                ],
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            sourceMap: true
                        }
                    },
                ]
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                sourceMap: true
                            }
                        },
                        {
                            loader: 'resolve-url-loader',
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                plugins: () => [
                                    require('autoprefixer')({
                                        browsers: ['last 2 versions']
                                    })
                                ],
                                sourceMap: true
                            }
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                includePaths: [
                                    `${__dirname}/resources/css`
                                ],
                                precision: 10,
                                sourceMap: true
                            }
                        }
                    ]
                })
            },
            {
                test: /\.html$/,
                use: [
                    {
                        loader: 'html-loader',
                        options: {
                            minimize: true,
                            removeComments: false,
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin('app.css')
    ]
};
