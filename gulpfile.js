'use strict';

var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var del = require('del');
var runSequence = require('run-sequence');

var paths = {
  scripts: 'assets/js/**/*.js',
  images: 'assets/img/**/*',
  scss: 'assets/scss/**/*.scss',
  css: 'assets/css/**/*.css',
  fonts: 'assets/fonts/**/*',
  php: '*.php',
  style: 'style.css',
  dist: 'dist/**/*',
  ionicons: 'assets/bower_components/ionicons/fonts/*',
  ioniconsCss: 'assets/bower_components/ionicons/css/ionicons.min.css',
};

gulp.task('jshint', function() {
  return gulp.src(paths.scripts)
    .pipe($.jshint())
    .pipe($.jshint.reporter('jshint-stylish'));
});

gulp.task('images', function() {
  return gulp.src(paths.images)
    .pipe($.cache($.imagemin({
      progressive: true,
      interlaced: true
    })))
    .pipe(gulp.dest('dist/img'))
    .pipe($.size({title: 'images'}));
});

gulp.task('fonts', function () {
  return gulp.src([
      paths.fonts,
      paths.ionicons
    ])
    .pipe(gulp.dest('dist/fonts'))
    .pipe($.size({title: 'fonts'}));
});

gulp.task('styles', function () {
  return gulp.src([
      paths.scss,
      paths.css,
      paths.ioniconsCss
    ])
    .pipe($.if('*.scss', $.sass({errLogToConsole: true})
    .on('error', console.error.bind(console))
    ))
    .pipe($.if('*.css', $.csso()))
    .pipe(gulp.dest('dist/css'))
    .pipe($.size({title: 'styles'}));
});

gulp.task('scripts', function() {
  // Minify and copy all JavaScript
  return gulp.src([
      paths.scripts
    ])
    .pipe($.uglify({preserveComments: 'some'}))
    .pipe($.concat('main.min.js'))
    .pipe(gulp.dest('dist/js'));
});

gulp.task('clean', del.bind(null, ['.tmp', 'dist', 'build']));

// Rerun the task when a file changes
gulp.task('watch', function() {
  gulp.watch(paths.css, ['styles']);
  gulp.watch(paths.scss, ['styles']);
  gulp.watch(paths.images, ['images']);
  gulp.watch(paths.scripts, ['scripts']);
});

gulp.task('default', ['clean'], function(cb) {
  runSequence('styles', ['jshint', 'images', 'fonts', 'scripts', 'watch'], cb);
});

gulp.task('build', function() {
  return gulp.src([
    paths.php,
    paths.style,
    paths.dist
  ])
  .pipe(gulp.dest('build'));
});
