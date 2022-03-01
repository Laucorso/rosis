const path = require('path');

const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  entry: [
    './entry.js'
  ],
  output: {
    path: path.resolve(__dirname, 'resources/js'),
    publicPath: '/',
    filename: 'app.bundle.js'
  },
  module: {
    rules: [
      {
        test: /\.font\.js/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              url: false
            }
          },
          require('webfonts-loader')
        ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'fonticons.css'
    })
  ],
};
