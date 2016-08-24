const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

var gulp = require('gulp');
var del = require('del');
var config = elixir.config;
var bowerDir = './bower_components';

function rootPath(path) {
    return '../../../' + path;
}

function bowerPath(path) {
    return rootPath(bowerDir + '/' + path);
}

elixir.extend('remove', function(path) {
    new elixir.Task('remove', function() {
        del(path);
    });
});

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

/*
|--------------------------------------------------------------------------
| Config
|--------------------------------------------------------------------------
*/

elixir.config.versioning.buildFolder = 'assets';

/*
|--------------------------------------------------------------------------
| Fonts
|--------------------------------------------------------------------------
*/

gulp.task('fonts', function () {
    gulp.src([
        bowerDir + '/bootstrap/fonts/*.*',
        bowerDir + '/font-awesome/fonts/*-webfont.*'
    ])
    .pipe(gulp.dest(config.get('public.versioning.buildFolder') + '/fonts'));
});

/*
|--------------------------------------------------------------------------
| BUILD
|--------------------------------------------------------------------------
*/

elixir(function(mix) {

    mix

    /*
    |--------------------------------------------------------------------------
    | LESS
    |--------------------------------------------------------------------------
    */

    // .less([
    //     'app.less'
    // ], 'resources/assets/css')

    /*
    |--------------------------------------------------------------------------
    | SASS
    |--------------------------------------------------------------------------
    */

    .sass('vendor.scss')
    // .sass([
    //     'app.scss'
    // ], 'resources/assets/css')

    /*
    |--------------------------------------------------------------------------
    | JS
    |--------------------------------------------------------------------------
    */

    .webpack('vendor.js')
    .webpack('app.js')

    // Vendor
    // .scripts([
    //     bowerPath('jquery/dist/jquery.js'),
    //     bowerPath('bootstrap/dist/js/bootstrap.js'),
    //     bowerPath('bootbox/bootbox.js'),
    //     'vendor/**/*.js'
    // ], config.get('public.js.outputFolder') + '/vendor.js')
    // // app.js
    // // .scripts([

    // // ], config.get('assets.js.folder') + '/app/all.js')
    // .scriptsIn(config.get('assets.js.folder') + '/app', config.get('public.js.outputFolder') + '/app.js')

    /*
    |--------------------------------------------------------------------------
    | CSS
    |--------------------------------------------------------------------------
    */

    // Vendor
    // .styles([
    //     bowerPath('bootstrap/dist/css/bootstrap.css'),
    //     bowerPath('font-awesome/css/font-awesome.css'),
    //     'vendor/**/*.css'
    // ], config.get('public.css.outputFolder') + '/vendor.css')
    // // app.css
    // // .styles([

    // // ], config.get('assets.css.folder') + '/app/theme.css')
    // .stylesIn(config.get('assets.css.folder') + '/app', config.get('public.css.outputFolder') + '/app.css')

    /*
    |--------------------------------------------------------------------------
    | Versioning / Cache Busting
    |--------------------------------------------------------------------------
    */

    .version([
        // JS
        config.get('public.js.outputFolder'),
        // CSS
        config.get('public.css.outputFolder')
    ])

    /*
    |--------------------------------------------------------------------------
    | BrowserSync
    |--------------------------------------------------------------------------
    */

    // .browserSync({
    //     proxy: 'laravel.dev'
    // })

    /*
    |--------------------------------------------------------------------------
    | Task
    |--------------------------------------------------------------------------
    */

    .task('fonts');
});
