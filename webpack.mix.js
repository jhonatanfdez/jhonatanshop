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



   mix.styles([
      'public/asset/plugins/OwlCarousel2-2.2.1/owl.carousel.css',
      'public/asset/plugins/OwlCarousel2-2.2.1/owl.theme.default.css',
      'public/asset/plugins/OwlCarousel2-2.2.1/animate.css',
      'public/asset/styles/comun.css'
  ], 'public/css/all.css');  



  mix.scripts([
   'public/asset/plugins/greensock/TweenMax.min.js',
   'public/asset/plugins/greensock/TimelineMax.min.js',
   'public/asset/plugins/scrollmagic/ScrollMagic.min.js',
   'public/asset/plugins/greensock/animation.gsap.min.js',
   'public/asset/plugins/greensock/ScrollToPlugin.min.js',
   'public/asset/plugins/OwlCarousel2-2.2.1/owl.carousel.js',
   'public/asset/plugins/easing/easing.js',
   'public/asset/plugins/progressbar/progressbar.min.js',
   'public/asset/plugins/parallax-js-master/parallax.min.js',
   'public/asset/js/custom.js'
], 'public/js/all.js');  

mix.js('resources/js/app_admin.js', 'public/js');














