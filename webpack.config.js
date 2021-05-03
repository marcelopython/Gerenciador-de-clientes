const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')


module.exports = {
    mode: "development",
    entry: './resources/js/app.js',
    output: {
        path: path.join(__dirname, '/public'),
        filename: './js/src/bundle.js',
    },
    resolve: {
        extensions: ['.js', '.jsx']
    },
    devServer: {
        port: 3000,
        watchContentBase: true
      },
    module: {
        rules: [
            {
              test: /\.(js|jsx)$/,
              exclude: /nodeModules/,
              use: {
                loader: 'babel-loader'
              }
            },
            {
              test: /\.css$/,
              use: ['style-loader', 'css-loader']
            }
          ]
    },
    // plugins: [new HtmlWebpackPlugin({ template: './public/index.html' })],
};
