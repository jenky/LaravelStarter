var elixir = require('laravel-elixir');
var gulp = require('gulp');
var config = elixir.config;

function rootPath(path) {
    return '../../../' + path
}

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
 | Paths
 |--------------------------------------------------------------------------
 */

var bowerPath = './bower_components';
var paths = {
    bower: {
        jquery: bowerPath + '/jquery',
        respond: bowerPath + '/respond',
        html5shiv: bowerPath + '/html5shiv',
        bootstrap: bowerPath + '/bootstrap',
        fontAwesome: bowerPath + '/font-awesome'
    },

    // build all files in this folder and use this as filename
    prefix: '' //
};

/*
 |--------------------------------------------------------------------------
 | Fonts
 |--------------------------------------------------------------------------
 */

gulp.task('fonts', function () {
    gulp.src([
        paths.bower.bootstrap + '/fonts/*.*',
        paths.bower.fontAwesome + '/fonts/*-webfont.*'
    ])
    .pipe(gulp.dest(config.get('public.versioning.buildFolder') + '/fonts'));
});

/*
 |--------------------------------------------------------------------------
 | BUILD
 |--------------------------------------------------------------------------
 */

elixir(function(mix) {

    var jsName = paths.prefix || 'app',
        cssName = paths.prefix || 'app';
    jsName += '.js';
    cssName += '.css';

    mix
    /*
     |--------------------------------------------------------------------------
     | JS
     |--------------------------------------------------------------------------
     */

    // JS - Vendor
    .scripts([
        rootPath(paths.bower.jquery + '/dist/jquery.js'),
        rootPath(paths.bower.bootstrap + '/dist/js/bootstrap.js'),
        'vendor**/*.js'
    ], config.get('public.js.outputFolder') + '/vendor.js')
    // JS - jsName || App
    .scriptsIn(config.get('assets.js.folder') + '/' + paths.prefix, config.get('public.js.outputFolder') + '/' + jsName)

    /*
     |--------------------------------------------------------------------------
     | CSS
     |--------------------------------------------------------------------------
     */

    // CSS - Vendor
    .styles([
        rootPath(paths.bower.bootstrap + '/dist/css/bootstrap.css'),
        rootPath(paths.bower.fontAwesome + '/css/font-awesome.css'),
        'vendor/**/*.css'
    ], config.get('public.css.outputFolder') + '/vendor.css')
    // CSS - jsName || App
    .stylesIn(config.get('assets.css.folder') + '/' + paths.prefix, config.get('public.css.outputFolder') + '/' + cssName)

    /*
     |--------------------------------------------------------------------------
     | LESS
     |--------------------------------------------------------------------------
     */

    // .less()

     /*
     |--------------------------------------------------------------------------
     | SASS
     |--------------------------------------------------------------------------
     */

    // .sass()

     /*
     |--------------------------------------------------------------------------
     | Versioning / Cache Busting
     |--------------------------------------------------------------------------
     */

    .version([
        // JS
        config.get('public.js.outputFolder') + '/vendor.js',
        config.get('public.js.outputFolder') + '/' + jsName,
        // CSS
        config.get('public.css.outputFolder') + '/vendor.css',
        config.get('public.css.outputFolder') + '/' + cssName,
    ])

     /*
     |--------------------------------------------------------------------------
     | Task
     |--------------------------------------------------------------------------
     */

    .task('fonts');
});
