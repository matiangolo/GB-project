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

// ----- General files (for the admin section)

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

// ----- Kiosk files
mix.js('resources/js/survey-kiosk.js', 'public/js')
    .vue()
    .sass('resources/sass/survey-kiosk.scss', 'public/css');

mix.browserSync({
    proxy: 'localhost:8000',
    port: 8100
});