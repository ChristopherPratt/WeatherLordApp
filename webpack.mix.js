const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
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
    })
    //.sass('resources/sass/app.scss', 'public/css')
    //.tailwind(); // add this so we can handle the tailwind files

;
//mix.browserSync('http://localhost:8000');


//mix.browserSync({
 //   open: false,
  //  proxy: "http://localhost:8000",
   // //proxy: 'domain.app',
    ////port: 8001,
    //files: ["public/css/*.css", "public/js/*.js", "resources/views/**/*"],
//});