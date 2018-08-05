// const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
// const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
var path = require("path");
const devMode = process.env.NODE_ENV !== 'production'

module.exports = {
	entry: {
		main: [
			'./resources/assets/js/app.js',
			'./resources/assets/sass/app.scss'
		]
	},
	output: {
		path: path.resolve(__dirname, 'public'),
		filename: '[name].js'
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name].css',
			chunkFilename: '[id].css'
		})
	],
  	optimization: {
		minimizer: [
			// new UglifyJsPlugin({
			// 	cache: true,
			// 	parallel: true,
			// 	sourceMap: true
			// }),
			new OptimizeCSSAssetsPlugin({})
		]
	},
	module: {
		rules: [
			{
				test: /\.(sa|sc|c)ss$/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'sass-loader',
				]
			},
			{
				test: /\.(woff2?|svg|jpe?g|png|gif|ico)$/,
				loader: 'url-loader?name=/fonts/[name].[ext]&limit=10000'
			}
		]
	}
}
