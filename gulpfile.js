'use strict';

var gulp = require('gulp');

var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');

var paths = {
  scripts: 'assets/js/**/*',
  styles: 'assets/scss/**/*',
  bootstrap: 'assets/bower_components/sass-bootstrap/lib/*',
  images: 'assets/img/**/*'
};

gulp.task('styles', function () {
  gulp.src(paths.styles)
    .pipe(sass({errLogToConsole: true}))
    .pipe(concat('custom.css'))
    .pipe(gulp.dest('dist/css'));
});

gulp.task('vendor-styles', function() {
  gulp.src(paths.bootstrap)
    .pipe(sass())
    .pipe(concat('vendor.css'))
    .pipe(gulp.dest('dist/css'));
});

gulp.task('scripts', function() {
  // Minify and copy all JavaScript
  return gulp.src(paths.scripts)
    .pipe(uglify())
    .pipe(concat('main.min.js'))
    .pipe(gulp.dest('dist/js'));
});

gulp.task('images', function() {
 return gulp.src(paths.images)
    .pipe(gulp.dest('dist/img'));
});

// Rerun the task when a file changes
gulp.task('watch', function() {
  gulp.watch(paths.styles, ['styles']);
  gulp.watch(paths.scripts, ['scripts']);
  gulp.watch(paths.images, ['images']);
});

gulp.task('default', ['styles', 'vendor-styles', 'scripts', 'images', 'watch']);