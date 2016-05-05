const path = require('path');
const webpack = require('webpack');
const dynamicEntry = path.resolve('./src/scripts/app.es6');


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
        loader: 'style!css!sass?outputStyle=expanded!' +
          'autoprefixer?{browsers:["last 2 version", "ie 10"]}'
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
  plugins: [new webpack.NoErrorsPlugin()],
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
