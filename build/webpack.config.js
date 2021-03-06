'use strict'

const path = require('path')
const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = {
  mode: 'development',
  entry: [
    './src/assets/web-components/index.js',
    './src/assets/scss/style.scss'
  ],
  output: {
      path: path.resolve(__dirname, '../static/dist'),
      filename: 'bundle.js',
      publicPath: '/'
  },
  resolve: {
    extensions: ['.js', '.vue'],
    alias: {
        'vue$': 'vue/dist/vue.esm.js',
        '@': path.resolve('src/assets'),
    }
  },
  module: {
    rules: [
      {
        test: /\.(js|vue)$/,
        loader: 'eslint-loader',
        enforce: 'pre',
        include: [path.resolve('src/assets')],
        options: {
          formatter: require('eslint-friendly-formatter')
        }
      },
      {
        test: /\.js$/,
        use: [
            {
                loader: 'babel-loader',
                options: {
                    presets: ['es2015', 'stage-2']
                }
            }
        ] 
      },
      {
        test: /\.vue$/,
        use: ['vue-loader'],
      },
      {
        test: /\.scss$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'bundle.css',
            },
          },
          'extract-loader',
          'css-loader', 
          'sass-loader',
        ],
      }
    ]
  },
  plugins: [
    new VueLoaderPlugin(),
  ]
}