const webpack = require('webpack');

module.exports = require('./webpack.base.js')({
    devtool: 'cheap-module-source-map',
    entry:   `${__dirname}/src/index`,
    out:     {
        path: `${__dirname}/dist/`,
        file: 'laravel-ui.min'
    },
    resolve: [
        `${__dirname}/src`,
        `${__dirname}/src/styles`,
    ],
    alias:   {
        vue: 'vue/dist/vue.js'
    },
    plugins: [
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        })
    ],
    rules: []
});
