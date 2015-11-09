var elixir = require('laravel-elixir');
var gulp = require('gulp');
var config = elixir.config;
var bowerDir = './bower_components';

function rootPath(path) {
    return '../../../' + path;
}

function bowerPath(path) {
    return rootPath(bowerDir + '/' + path);
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
        jquery: bowerDir + '/jquery',
        respond: bowerDir + '/respond',
        html5shiv: bowerDir + '/html5shiv',
        bootstrap: bowerDir + '/bootstrap',
        fontAwesome: bowerDir + '/font-awesome'
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
     | JS
     |--------------------------------------------------------------------------
     */

    // Vendor
    .scripts([
        bowerPath('jquery/dist/jquery.js'),
        bowerPath('bootstrap/dist/js/bootstrap.js'),
        bowerPath('bootbox/bootbox.js'),
        'vendor/**/*.js'
    ], config.get('public.js.outputFolder') + '/vendor.js')
    // jsName || App
    .scriptsIn(config.get('assets.js.folder') + '/' + paths.prefix, config.get('public.js.outputFolder') + '/' + jsName)

    /*
     |--------------------------------------------------------------------------
     | CSS
     |--------------------------------------------------------------------------
     */

    // Vendor
    .styles([
        bowerPath('bootstrap/dist/css/bootstrap.css'),
        bowerPath('font-awesome/css/font-awesome.css'),
        'vendor/**/*.css'
    ], config.get('public.css.outputFolder') + '/vendor.css')
    // cssName || App
    .stylesIn(config.get('assets.css.folder') + '/' + paths.prefix, config.get('public.css.outputFolder') + '/' + cssName)

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
