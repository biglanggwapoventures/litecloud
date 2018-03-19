let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/login.scss', 'public/css')
    .sass('resources/assets/sass/files.scss', 'public/css');
