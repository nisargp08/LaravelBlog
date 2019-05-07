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
/*For custom javascripts*/
mix.scripts([
    'resources/js/script.js'
],'public/js/script.js');

/*For image upload dropbox*/
mix.scripts([
    'resources/dropzone/min/dropzone.min.js',
],'public/js/dropzone.js');

