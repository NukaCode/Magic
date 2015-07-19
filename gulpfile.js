var elixir = require('laravel-elixir');

var bower_dir = 'vendor/bower_components/';

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

elixir(function (mix) {
    mix.copy('resources/assets/less/theme.config', bower_dir + 'semantic-ui/src/theme.config')
        .less('app.less', 'resources/assets/css/')
        // JS
        .copy(bower_dir + 'jquery/dist/jquery.min.js', 'resources/assets/js/vendor/jquery.js')
        .copy(bower_dir + 'messenger/build/js/messenger.min.js', 'resources/assets/js/vendor/messenger.js')
        .copy(bower_dir + 'messenger/build/js/messenger-theme-future.js', 'resources/assets/js/vendor/messenger-theme-future.js')
        .copy(bower_dir + 'vue/dist/vue.js', 'resources/assets/js/vendor/vue.js')
        .copy(bower_dir + 'vue-resource/dist/vue-resource.js', 'resources/assets/js/vendor/vue-resource.js')
        .copy(bower_dir + 'semantic-ui/dist/semantic.js', 'resources/assets/js/vendor/semantic.js')
        .copy(bower_dir + 'algoliasearch/dist/algoliasearch.js', 'resources/assets/js/vendor/algoliasearch.js')
        .scripts(
        [
            'vendor/jquery.js',
            'vendor/messenger.js',
            'vendor/messenger-theme-future.js',
            'vendor/vue.js',
            'vendor/vue-resource.js',
            'vendor/semantic.js',
            'vendor/algoliasearch.js',
        ], 'public/js/all.js')
        // CSS
        .copy(bower_dir + 'font-awesome/css/font-awesome.min.css', 'resources/assets/css/vendor/font-awesome.css')
        .copy(bower_dir + 'messenger/build/css/messenger.css', 'resources/assets/css/vendor/messenger.css')
        .copy(bower_dir + 'messenger/build/css/messenger-theme-future.css', 'resources/assets/css/vendor/messenger-theme-future.css')
        .copy(bower_dir + 'semantic-ui/dist/semantic.css', 'resources/assets/css/vendor/semantic.css')
        .styles(
        [
            'app.css',
            'vendor/font-awesome.css',
            'vendor/messenger.css',
            'vendor/messenger-theme-future.css',
        ], 'public/css/all.css')
        // Extras
        .copy(bower_dir + 'font-awesome/fonts', 'public/fonts')
        .copy(bower_dir + 'semantic-ui/src/themes/default/assets/fonts', 'public/css/themes/default/assets/fonts')
    ;
});
