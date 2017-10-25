'use strict';

/*
 * Dependencias
 */

var gulp = require('gulp'),
  postcss = require('gulp-postcss'),
  autoprefixer = require('autoprefixer'),
  sass = require('gulp-sass'),
  uglify = require('gulp-uglify'),
  rename = require('gulp-rename'),
  sourcemaps = require('gulp-sourcemaps'),
  clean = require('gulp-clean'),
  gnf = require('gulp-npm-files');

/**
 * Tarea por default
 */
gulp.task('default', gulp.series('sass', 'scripts', 'watch'));

/**
 * Procesa los archivos sass .scss hacia preprocesados/scss hacia public/assets/css
 */
gulp.task('sass', function () {
  var processors = [
    autoprefixer
  ];

  return gulp.src('./preprocesados/sass/**/*.scss')
    .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
    .pipe(postcss(processors))
    //.pipe(gulp.dest('sitio/css'))
    .pipe(rename({extname: '.min.css'}))
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(postcss(processors))
    .pipe(clean())
    .pipe(gulp.dest('public/assets/css'));
});

/**
 * Copia los scripts de preprocesados a public/assets/js normal y comprimidos
 */
gulp.task('scripts', function () {
  return gulp.src('./preprocesados/js/**/*.js')
    .pipe(rename({extname: '.min.js'}))
    .pipe(uglify().on('error', function (e) {
      console.log(e);
    }))
    .pipe(clean())
    .pipe(gulp.dest('public/assets/js'));
});

/**
 * Copia de node_modules solo las dependencias de producción hacia public/assets/node_modules
 */
gulp.task('npmtositio', function () {
  gulp
    .src(gnf(null, './package.json'), {base: './'})
    .pipe(gulp.dest('public/assets'));
});

/**
 * Watch para sass, scripts y módulos de node
 */
gulp.task('watch', function () {
  gulp.watch('sass/**/*.scss', {cwd: './preprocesados/'}, ['sass']);
  gulp.watch('js/**/*.js', {cwd: './preprocesados/'}, ['scripts']);
});