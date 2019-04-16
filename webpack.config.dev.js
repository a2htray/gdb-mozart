'use strict';
const path = require('path');
const webpack = require('webpack');
const { VueLoaderPlugin } = require('vue-loader');

module.exports = {
    mode: 'development',
    entry: [
        './resources/js/app.js'
    ],
    output: {
        path: path.resolve(__dirname, './../../../public/js'),
        filename: 'gdb-mozart.app.js'
    },
    devServer: {
        hot: true,
        watchOptions: {
            poll: true
        }
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                use: 'vue-loader',
            },
            {
                test: /\.js$/,
                use: 'babel-loader',
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader', 'stylus-loader', 'sass-loader'],
            },
            {
                test: /\.styl$/,
                use: ['style-loader', 'css-loader', 'stylus-loader'],
            },
            {
              test: /\.scss$/,
              use: ['style-loader', 'css-loader', 'sass-loader'],
            },
            {
                test: /\.(ttf|eot|woff|woff2|svg)/,
                use: ['file-loader'],
            }
        ]
    },
    plugins: [
        new webpack.HotModuleReplacementPlugin(),
        new VueLoaderPlugin(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.js'
        }
    }
};
