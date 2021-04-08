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
    .sourceMaps()
    .js('resources/js/admin/admin.js', 'public/js')
    .js('resources/js/experience.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/experience.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/hyster.scss', 'public/css')
    .sass('resources/sass/yale.scss', 'public/css')
    .sass('resources/sass/fonts.scss', 'public/css')
    .copy([
        './node_modules/@fortawesome/fontawesome-free/webfonts',
    ], 'public/fonts')
    .copy([
        'resources/fonts',
    ], 'public/fonts')
    .copy([
        'app/Modules/Experience/Resources/3dvista',
    ], 'public/3dvista')
    .options({
        processCssUrls: false
    })
    .webpackConfig({
        devtool: "inline-source-map"
    })
    .version();
