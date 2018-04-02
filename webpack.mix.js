let mix = require('laravel-mix');

mix.js('resources/assets/admin/js/app.js', 'public/admin/js')
   .sass('resources/assets/admin/sass/app.scss', 'public/admin/css');

mix.js('resources/assets/site/js/app.js', 'public/site/js')
   .sass('resources/assets/site/sass/app.scss', 'public/site/css');
