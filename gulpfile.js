var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles('bootstrap.css');
    mix.less('style.less');

    mix.copy('resources/js/squire.js', 'public/js/squire.js');

    mix.browserSync({
        proxy: 'http://localhost/brebouvie/public/'
    });

});
