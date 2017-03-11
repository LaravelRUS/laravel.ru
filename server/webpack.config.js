const path              = require('path');
const webpack           = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

// Config
module.exports = {
    entry: [
        './resources/js/bootstrap'
    ],
    output: {
        path: `${__dirname}/public/dist/`,
        filename: 'app.js'
    },
    resolve: {
        modulesDirectories: ['node_modules', 'resources'],
        extensions: ['', '.js', '.ts', '.scss']
    },
    devtool: '#inline-source-map',
    module: {
        loaders: [
            {
                test: /\.js?$/,
                loaders: ['babel'],
                exclude: /node_modules/
            },
            {
                test: /\.scss$/,
                loader: ExtractTextPlugin.extract("style", "css!postcss!sass")
            }
        ]
    },
    postcss: () => {
        return [
            require('autoprefixer')
        ];
    },
    plugins: [
        new ExtractTextPlugin('app.css')
    ]
};