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

mix.js('resources/js/app.js', 'public/js').sourceMaps().version();
mix.sass('resources/sass/app.scss', 'public/css', [
  require('autoprefixer')({
    browsers: ['last 40 versions']
  })
]).version();

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json', '.scss'],
    alias: {
      '@': __dirname + '/resources/js',
      '@product': __dirname + '/Modules/Product/Resources/assets/js',
      '@initializer': __dirname + '/Modules/Initializer/Resources/assets/js'
    }
  }
})
