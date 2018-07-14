let mix = require('laravel-mix');
/*
var HtmlWebpackPlugin = require('html-webpack-plugin');
const PrerenderSpaPlugin = require('prerender-spa-plugin');
const path = require('path');*/


/*mix.webpackConfig({
    plugins: [
        new HtmlWebpackPlugin({
            template: __dirname + '/resources/views/index.html',
            inject: false
        }),
        new PrerenderSpaPlugin(
            // Path to compiled app
            __dirname + '/public'   ,
            // List of endpoints you wish to prerender
            [ '/', '/contacts/create', '/soccer_expert'],
            {

            }
        ),
    ]
});*/


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/frontend/js/app.js', 'public/frontend/js')
   .sass('resources/assets/frontend/sass/app.scss', 'public/frontend/css');
