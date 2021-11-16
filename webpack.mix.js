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
    .vue()
    // .sass('resources/sass/app.scss', 'public/css', [
    //     require('postcss-import'),
    //     require('tailwindcss'),
    //     require('autoprefixer')])
    
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer')])
    .browserSync
    ({
        open: false,
        tunnel: true,
        proxy: "http://localhost:8000",
        //proxy: 'domain.app',
        //port: 48439,
        //files: ["public/css/*.css", "public/js/*.js", "resources/views/**/*"],
    });
