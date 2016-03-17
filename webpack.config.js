const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const autoprefixer = require('autoprefixer');
const precss = require('precss');

const dynamicEntry = path.resolve('./src/scripts/app.es6');

const styleList = 'style!css!sass?outputStyle=expanded!' +
  'autoprefixer?{browsers:["last 2 version", "ie 10"]}';
const dynamicCssLoader = process.env.NODE_ENV !== 'production' ?
  styleList : ExtractTextPlugin.extract(styleList);

const dynamicPluginLoader = process.env.NODE_ENV !== 'production' ?
[new webpack.NoErrorsPlugin()] :
[new webpack.NoErrorsPlugin(), new ExtractTextPlugin('main.css')];

module.exports = {
  entry: {
    'dist/js/main.min': dynamicEntry
  },
  output: {
    path: './',
    filename: '[name].js',
    publicPath: '/'
  },

  eslint: {
    configFile: './.eslintrc.js',
    failOnError: false,
    failOnWarning: false,
    emitError: true
  },
  postcss: function postcss() {
    return [
      autoprefixer({ browsers: ["last 2 versions"] }),
      precss
    ];
  },

  module: {
    loaders: [
      {
        test: /\.es6\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        query: {
          presets: ['es2015']
        }
      },
      {
        test: /\.mustache$/,
        loader: 'hgn'
      },
      {
        test: /\.scss$/,
        loader: dynamicCssLoader
      }
    ],
    preLoaders: [
      {
        test: /\.es6\.js$/,
        loader: 'eslint',
        exclude: /node_modules/
      }
    ]
  },
  plugins: dynamicPluginLoader,
  stats: {
    // Nice colored output
    colors: true
  },
  resolve: {
    root: path.resolve(__dirname),
    extensions: ['', '.js', '.es6.js', '.mustache'],
    alias: {
      collections: 'src/scripts/collections',
      controllers: 'src/scripts/controllers',
      models: 'src/scripts/models',
      services: 'src/scripts/services',
      templates: 'src/scripts/templates',
      views: 'src/scripts/views',
      helpers: 'src/scripts/helpers'
    }
  },
  // Create source maps for the bundle
  devtool: 'source-map'
};
