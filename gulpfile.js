"use strict";

import gulp from 'gulp';
import autoprefixer from 'gulp-autoprefixer';
import cssbeautify from 'gulp-cssbeautify';
import cleanCSS from 'gulp-clean-css';
import rename from 'gulp-rename';
import rigger from 'gulp-rigger';
import sass from 'gulp-sass';
import * as sassCompiler from 'sass'; // Використання нового синтаксису імпорту
import uglify from 'gulp-uglify';
import plumber from 'gulp-plumber';
import notify from 'gulp-notify';

// Налаштування шляхів
const paths = {
  scss: './src/scss/**/*.scss',
  css: './public/css'
};

const path = {
  build: {
    css: "./public/css",
    js: "./public/js",
  },
  src: {
    css: "./src/scss/*.scss", // Переконайтеся, що шлях вірний
    js: "./src/lib/*.js",
  },
  watch: {
    css: "./src/scss/**/*.scss", // Переконайтеся, що шлях вірний
    js: "./src/lib/*.js",
  }
};

// Функція css
function css() {
  return gulp.src(path.src.css, { base: "web/themes/custom/mytheme/sass/" })
    .pipe(plumber({
      errorHandler: function(err) {
        notify.onError({
          title: "SCSS Error",
          message: "Error: <%= error.message %>"
        })(err);
        this.emit('end');
      }
    }))
    .pipe(sass(sassCompiler).on('error', sass.logError)) // Передайте компілятор в функцію sass
    .pipe(autoprefixer())
    .pipe(cssbeautify())
    .pipe(gulp.dest(path.build.css))
    .pipe(cleanCSS({
      compatibility: 'ie8'
    }))
    .pipe(rename({
      suffix: ".min",
      extname: ".css"
    }))
    .pipe(gulp.dest(path.build.css));
}

// Функція js
function js() {
  return gulp.src(path.src.js, { base: "web/themes/custom/mytheme/lib/" })
    .pipe(plumber({
      errorHandler: function(err) {
        notify.onError({
          title: "JS Error",
          message: "Error: <%= error.message %>"
        })(err);
        this.emit('end');
      }
    }))
    .pipe(rigger())
    .pipe(gulp.dest(path.build.js))
    .pipe(uglify())
    .pipe(rename({
      suffix: ".min",
      extname: ".js"
    }))
    .pipe(gulp.dest(path.build.js));
}

// Функція для спостереження за файлами
function watchFiles() {
  gulp.watch(path.watch.css, css);
  gulp.watch(path.watch.js, js);
}

// Налаштування задач Gulp
const build = gulp.series(css, gulp.parallel(js));
const watchTask = gulp.parallel(build, watchFiles);

export { css, js, build, watchTask };
export default watchTask;
