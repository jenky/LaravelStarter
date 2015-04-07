//////////////////////////////////////////////////
// REQUIRE
//////////////////////////////////////////////////

var gulp = require('gulp');
// var elixir = require('laravel-elixir');

// JS
// var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');

// CSS
var less = require('gulp-less');
var sass = require('gulp-sass');
var prefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');

// HTML
// var minifyhtml = require('gulp-minify-html');

// IMAGE
// var imagemin = require('gulp-imagemin');

// UTIL
var concat = require('gulp-concat');
var rename = require('gulp-rename');
// var cache = require('gulp-cache');
var del = require('del');
var rev = require('gulp-rev');
var plumber = require('gulp-plumber');
var path = require('path');

// DEV
// var notify = require('gulp-notify');

//////////////////////////////////////////////////
// FUNCTIONS
//////////////////////////////////////////////////
function swallowError (error) {
    //If you want details of the error in the console
    console.log(error.toString());

    this.emit('end');
}

//////////////////////////////////////////////////
// PATHS
//////////////////////////////////////////////////

var paths = {
  app: {
    root: 'app',
    assets: 'resources/assets',
    build: 'resources/build',
  },

  public: {
    root: 'public',
    assets: 'public/assets'
  },

  bower: {
    jquery: 'bower_components/jquery',
    respond: 'bower_components/respond',
    html5shiv: 'bower_components/html5shiv',
    bootstrap: 'bower_components/bootstrap',
    fontAwesome: 'bower_components/font-awesome',
    jqueryCookie: 'bower_components/jquery-cookie'
  }
};

//////////////////////////////////////////////////
// JS Tasks
//////////////////////////////////////////////////

gulp.task('js:vendor', function() {
  return gulp.src([
    // Specific order required by Bootstrap
    // paths.bower.bootstrap + '/js/transition.js',
    // paths.bower.bootstrap + '/js/alert.js',
    // paths.bower.bootstrap + '/js/button.js',
    // paths.bower.bootstrap + '/js/carousel.js',
    // paths.bower.bootstrap + '/js/collapse.js',
    // paths.bower.bootstrap + '/js/dropdown.js',
    // paths.bower.bootstrap + '/js/modal.js',
    // paths.bower.bootstrap + '/js/tooltip.js',
    // paths.bower.bootstrap + '/js/popover.js',
    // paths.bower.bootstrap + '/js/scrollspy.js',
    // paths.bower.bootstrap + '/js/tab.js',
    // paths.bower.bootstrap + '/js/affix.js',
    // paths.bower.jqueryCookie + '/jquery.cookie.js',
    // paths.app.assets + '/js/vendor.js'
    
    paths.bower.jquery + '/dist/jquery.min.js',
    paths.bower.bootstrap + '/dist/js/bootstrap.min.js',
    // paths.bower + '/bootbox/bootbox.js',
    // paths.app.assets + '/js/moment-with-locales.min.js',

    paths.app.assets + '/vendor/js/**/*.js'
  ])
    .pipe(plumber({
        handleError: function (err) {
            console.log(err);
            this.emit('end');
        }
    }))
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest(paths.app.build + '/js'));
});

gulp.task('js:app', function() {
  return gulp.src([
    // Supporting specific order
    paths.app.assets + '/js/**/*.js'
  ])
    .pipe(plumber({
        handleError: function (err) {
            console.log(err);
            this.emit('end');
        }
    }))
    .pipe(concat('app.js'))
    .pipe(gulp.dest(paths.app.build + '/js'));
});


gulp.task('js:pub', ['js:vendor', 'js:app'], function() {
  return gulp.src(paths.app.build + '/js/**/*.js')
    .pipe(plumber({
        handleError: function (err) {
            console.log(err);
            this.emit('end');
        }
    }))
    .pipe(uglify())
    .pipe(gulp.dest(paths.public.root + '/js'));
});

//////////////////////////////////////////////////
// CSS Tasks
//////////////////////////////////////////////////

gulp.task('less:build', function () {
  return gulp.src([
    paths.app.assets + '/less/*.less', 
    paths.app.assets + '/less/**/*.less'
  ])
    .pipe(less())
    .pipe(gulp.dest(paths.app.build + '/css'));
});

gulp.task('sass:build', function () {
  return gulp.src([
    paths.app.assets + '/sass/*.scss', 
    paths.app.assets + '/sass/**/*.scss'
  ])
    .pipe(sass())
    .pipe(gulp.dest(paths.app.build + '/css'));
});

gulp.task('css:vendor', function() {
  return gulp.src([    
    paths.bower.bootstrap + '/dist/css/bootstrap.min.css',
    paths.bower.fontAwesome + '/css/font-awesome.min.css',

    paths.app.assets + '/vendor/css/**/*.css'
  ])
    .pipe(concat('vendor.css'))
    .pipe(prefixer())
    .pipe(minifycss())
    .pipe(gulp.dest(paths.public.root + '/css'));
});

gulp.task('css:pub', ['less:build', 'sass:build'], function() {
  return gulp.src([
    paths.app.assets + '/css/**/*.css',
    paths.app.build + '/css/**/*.css'
  ])
    .pipe(prefixer())
    .pipe(minifycss())
    .pipe(concat('app.css'))
    .pipe(gulp.dest(paths.public.root + '/css'));
});

gulp.task('fonts:pub', function () {
  return gulp.src([
    paths.bower.bootstrap + '/fonts/*.*',
    paths.bower.fontAwesome + '/fonts/*-webfont.*'
  ])
    .pipe(gulp.dest(paths.public.assets + '/fonts'));
});

//

gulp.task('version', ['clean', 'js:pub', 'css:pub', 'css:vendor'], function() {
  // elixir(function(mix) {
  //   mix.version(['js/app.js', 'js/vendor.js', 'css/app.css', 'css/vendor.css']);
  //   mix.copy(paths.public.root + '/fonts', paths.public.root + '/build/fonts');
  // });
  return gulp.src([
    paths.public.root + '/js/*.js',
    paths.public.root + '/css/*.css'
  ], {base: path.join(process.cwd(), paths.public.root)})
    .pipe(rev())
    .pipe(gulp.dest(paths.public.assets))
    .pipe(rev.manifest())
    .pipe(gulp.dest(paths.public.assets));
});

//////////////////////////////////////////////////
// WATCH Tasks
//////////////////////////////////////////////////

gulp.task('js:watch', function () {
  gulp.watch(paths.app.assets + '/js/**/*.js', ['js:pub', 'version']);
});

gulp.task('less:watch', function () {
  gulp.watch(paths.app.assets + '/less/**/*.less', ['css:pub', 'version']);
});

gulp.task('sass:watch', function () {
  gulp.watch(paths.app.assets + '/sass/**/*.scss', ['css:pub', 'version']);
});

gulp.task('css:watch', function () {
  gulp.watch([paths.app.assets + '/css/**/*.css', paths.app.assets + '/vendor/**/*.css'], ['css:vendor', 'css:pub', 'version']);
});

//////////////////////////////////////////////////
// CLEAN Tasks
//////////////////////////////////////////////////

gulp.task('clean:pre', function () {
  return gulp.src([
    paths.app.build + '/**/*',
    '!' + paths.app.build + '/.gitignore',
    paths.public.assets + '/{js,css,fonts}/**/*'
  ])
    .pipe(clean());
});

gulp.task('clean:post', function () {
  return gulp.src([
    paths.app.build + '/**/*',
  ])
    .pipe(clean());
});

gulp.task('clean', function(cb) {
  del([
    paths.public.assets + '/js/**/*',
    paths.public.assets + '/css/**/*',
    paths.public.assets + '/rev-manifest.json'
  ], cb);
});

//////////////////////////////////////////////////
// BUILD Tasks
//////////////////////////////////////////////////

gulp.task('build:dev', []);
gulp.task('build:prod', []);

// gulp clean:pre && gulp TASK && gulp clean:post
gulp.task('default', ['js:pub', /*'js:lib',*/ 'css:vendor', 'css:pub', 'fonts:pub', 'js:watch', 'less:watch', 'sass:watch', 'css:watch', 'version']);
