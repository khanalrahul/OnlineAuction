// File: webpack.mix.js

const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
      //
   ]);

// Optionally, you can use versioning or other Mix features here.

