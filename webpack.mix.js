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
/*
    mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/isdb-bisew/app.scss', 'public/themes-assets/isdb-bisew/css')
    .sass('resources/sass/app.scss', 'public/css');
*/
let productionSourceMaps = false;

mix
  .sass('resources/source/default/sass/app.scss', 'public/themes-assets/default/css')
  // .sass('resources/source/default/sass/print.scss', 'public/themes-assets/default/js/print')
  .js('resources/source/default/js/app.js', 'public/themes-assets/default/js')
  .sourceMaps(productionSourceMaps, 'source-map');

if (mix.inProduction()) {
  mix.version();
}


// mix.js('resources/source/techsolution/js/app.js', 'public/themes-assets/techsolution/js')
//     .sass('resources/source/techsolution/sass/app.scss', 'public/themes-assets/techsolution/css')
//     .sourceMaps(true, 'source-map');

// if (mix.inProduction()) {
//     mix.version();
// }


// mix.browserSync('dev.isdb-bisew-three');
