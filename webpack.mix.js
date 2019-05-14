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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

/*For admin panel sidebar*/
mix.styles([
    'resources/css/adminSidebar.css'
],'public/css/adminSidebar.css');
mix.styles([
    'resources/dropzone/min/dropzone.min.css'
],'public/css/dropzone.css');
/*For admin charts*/
mix.styles([
    'node_modules/chart.js/dist/Chart.css'
],'public/css/chart.css');

/*For comment box*/
mix.scripts([
    'resources/css/commentBox.css',
],'public/css/commentBox.css');
/*For custom javascripts*/
mix.scripts([
    'resources/js/script.js'
],'public/js/script.js');
/*For image upload dropbox*/
mix.scripts([
    'resources/dropzone/min/dropzone.min.js',
],'public/js/dropzone.js');
/*For admin dashboard charts*/
mix.scripts([
    'node_modules/chart.js/dist/Chart.bundle.js',
],'public/js/chart.js');


