var webpack = require('webpack');
var path = require('path');

var BUILD_DIR = path.resolve(__dirname, 'web');
var APP_DIR = path.resolve(__dirname, 'react');
var config = {
    entry: [
        APP_DIR + '/app.jsx',
    ],
    output: {
        path: BUILD_DIR,
        filename: 'react/app.js',
    },
    module: {
        loaders: [{
            test: require.resolve("jquery"),
            loader: "imports?jQuery=jquery"
        }, {
            test: /.jsx?$/,
            loader: 'babel-loader',
            exclude: /node_modules/,
            query: {
              presets: ['es2015', 'react']
            }
        },
        {
            test: /\.css$/,
            loaders: ['style', 'css', 'less']
        }]
    },
    resolve: {
        alias: {
            jquery: "jquery/src/jquery"
        }
    },
    plugins: [
        new webpack.HotModuleReplacementPlugin(),
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            }
        }),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        })
    ],
};

module.exports = config;
