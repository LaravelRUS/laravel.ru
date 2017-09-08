const webpack            = require('webpack');
const ExtractTextPlugin  = require('extract-text-webpack-plugin');

module.exports = (config) => {
    const JsLoader = [
        {
            loader:  'babel-loader',
            options: {
                sourceMap: true
            }
        },
    ];

    const CssLoader = ExtractTextPlugin.extract({
        use:      [
            {
                loader:  'css-loader',
                options: {
                    url:       true,
                    minimize:  true,
                    import:    true,
                    sourceMap: true
                }
            },
            {
                loader:  'postcss-loader',
                options: {
                    sourceMap: true
                }
            },
            {
                loader:  'sass-loader',
                options: {
                    includePaths: config.resolve,
                    precision:    10,
                    sourceMap:    true
                }
            }
        ],
        fallback: 'vue-style-loader'
    });


    return {
        entry:   config.entry,
        devtool: config.devtool,
        output:  {
            path:     config.out.path,
            filename: (config.out.file || 'index') + '.js'
        },
        resolve: {
            modules: config.resolve.concat(['node_modules']),
            alias:   config.alias
        },
        module:  {
            rules: [
                {
                    test:    /\.vue$/,
                    loader:  'vue-loader',
                    options: {
                        esModule: false,
                        preserveWhitespace: false,
                        extractCSS:         true,
                        loaders:            {
                            scss: CssLoader,
                            sass: CssLoader,
                            css:  CssLoader,
                            js:   JsLoader,
                        }
                    }
                },
                {
                    test:    /\.js$/,
                    include: config.resolve.concat(['node_modules']),
                    use:     JsLoader
                },
                {
                    test: /\.(:?sc|sa|c)ss$/,
                    use:  CssLoader
                },
           ].concat(config.rules || [])
        },
        plugins: config.plugins.concat([
            new ExtractTextPlugin((config.out.file || 'index') + '.css'),
            new webpack.optimize.ModuleConcatenationPlugin(),
        ])
    }
};
