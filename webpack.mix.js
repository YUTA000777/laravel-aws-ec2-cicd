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

mix.js('resources/js/assets/aos.js', 'public/js')
   .js('resources/js/assets/app.js', 'public/js')
   .js('resources/js/assets/bootstrap.min.js', 'public/js')
   .js('resources/js/assets/contact.js', 'public/js')
   .js('resources/js/assets/custom.js', 'public/js')
   .js('resources/js/assets/isotope.js', 'public/js')
   .js('resources/js/assets/jquery.easing.min.js', 'public/js')
   .js('resources/js/assets/jquery.backstretch.min.js', 'public/js')
   .js('resources/js/assets/jquery.mb.YTPlayer.js', 'public/js')
   .js('resources/js/assets/jquery.min.js', 'public/js')
   .js('resources/js/assets/jquery.simple-text-rotator.js', 'public/js')
   .js('resources/js/assets/jquery.wavify.js', 'public/js')
   .js('resources/js/assets/owl.carousel.min.js', 'public/js')
   .js('resources/js/assets/parallax.js', 'public/js')
   .js('resources/js/assets/particles.app.js', 'public/js')
   .js('resources/js/assets/particles.js', 'public/js')
   .js('resources/js/assets/popper.min.js', 'public/js')
   .js('resources/js/assets/scrollspy.min.js', 'public/js')
   .js('resources/js/assets/TweenMax.min.js', 'public/js')
   .js('resources/js/assets/typed.js', 'public/js')
   .js('resources/js/assets/wavify.js', 'public/js')
    
    .sass('resources/sass/assets/app.scss', 'public/css')
    .version();
