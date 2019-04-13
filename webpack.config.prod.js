'use strict';
const path = require('path');
const webpack = require('webpack');
const { VueLoaderPlugin } = require('vue-loader');
// const HtmlWebpackPlugin = require('html-webpack-plugin')

module.exports = {
    mode: 'production',
    entry: [
        './resources/js/app.js'
    ],
    output: {
        path: path.resolve(__dirname, './resources/dist/js') ,
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
                exclude: /node_modules/,
            },
            {
                test: /\.js$/,
                use: 'babel-loader',
                exclude: /node_modules/,
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader', 'stylus-loader'],
                // exclude: /node_modules/,
            },
            {
                test: /\.styl$/,
                use: ['style-loader', 'css-loader', 'stylus-loader'],
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