var webpack = require('webpack');

module.exports = {
  entry: './js/main.js',
  output: {
    path: __dirname,
    filename: 'bundle.js'
  },
  module: {
    loaders: [
      {test: /\.css$/, loader: 'style-loader!css-loader'},
      { test: /\.(jpg|png)$/, loaders: ['url-loader?limit=1000', 'image-webpack']},
    //   { test: /\.png$/, loader: "url-loader?mimetype=image/png" },
      {test: /\.html$/,loader: 'file-loader?name=[path][name].[ext]!extract-loader!html-loader'}
    ]
  }
}