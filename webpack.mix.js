const mix = require('laravel-mix');

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

mix.react('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

//login page
mix.react('resources/assets/js/pages/custom/login/login-1.js', 'public/js/login.js')
   .sass('resources/assets/sass/pages/login/login-1.scss', 'public/css/login.css');
//invoice
mix.sass('resources/assets/sass/pages/invoices/invoice-1.scss', 'public/css/invoice.css');

//select2
mix.react('resources/assets/js/pages/crud/forms/widgets/select2.js', 'public/js/select2.js');
// copy images folder into laravel public folder
// mix.copyDirectory('resources/demo4/src/assets/media', 'public/assets/media');

//dashboard js
mix.react('resources/assets/js/pages/dashboard.js', 'public/js/dashboard.js');

//datatables
mix.react('resources/assets/js/global/components/base/datatable/core.datatable.js', 'public/js/datatable.js');


/**
 * plugins specific issue workaround for webpack
 * @see https://github.com/morrisjs/morris.js/issues/697
 * @see https://stackoverflow.com/questions/33998262/jquery-ui-and-webpack-how-to-manage-it-into-module
 */
mix.webpackConfig({
    resolve: {
        alias: {
            'morris.js': 'morris.js/morris.js',
            'jquery-ui': 'jquery-ui',
        },
    },
});
