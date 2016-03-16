const path = require('path');
const webpack = require('webpack');
const dirDist = path.resolve(__dirname, 'dist');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

const dynamicEntry = path.resolve('./src/scripts/app.es6');

const dynamicCssLoader = process.env.NODE_ENV !== 'production' ?
  'style-loader!' +
  'css-loader!autoprefixer-loader?{browsers:["last 2 version", "ie 10"]}!' +
  'sass-loader?outputStyle=expanded' : ExtractTextPlugin.extract(
  'style',
  'css!autoprefixer?{browsers:["last 2 version", "ie 10"]}!' +
  'sass?outputStyle=expanded');

const dynamicPluginLoader = process.env.NODE_ENV !== 'production' ? [
  new webpack.NoErrorsPlugin()
] : [
  new webpack.NoErrorsPlugin(),
  new ExtractTextPlugin('main.css')
];

module.exports = {
  entry: {
    'dist/js/main.min': dynamicEntry
  },
  output: {
    path: './',
    filename: '[name].js',
    publicPath: '/'
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
