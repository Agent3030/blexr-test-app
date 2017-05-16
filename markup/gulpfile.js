"use strict";

//require('es6-promise').polyfill();
var browserSync = require('browser-sync').create();
var inject = require('gulp-inject');
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var eslint = require('gulp-eslint');
var bower = require('bower');
var sass = require('gulp-sass');
var $ = require('gulp-load-plugins')();
var autoprefixer = require('gulp-autoprefixer');
var watch = require('gulp-watch');
var wiredep = require('wiredep').stream;
var _ = require('lodash');


var paths = {
    src: {
        sass: 'src/sass/',
        fonts: 'src/fonts/',
        js: 'src/js/',
        root: 'src/'
    },
    dist: {
        css: 'dist/css/',
        js: 'dist/js/',
        fonts: 'dist/fonts/',
        root: 'dist/'
    },
    bower: 'vendor/bower/',
    npm: 'node_modules/',
    app: '/',
    root: '.'
};

var config = {
    sassOptions: {
        includePaths: [
            paths.src.sass + '*.scss',
            paths.bower + 'compass-mixins/lib',
            paths.bower + 'bourbon/app/assets/stylesheets',
           // paths.bower + 'font-awesome/scss'
        ],
        style: 'expanded'
    },    
    autoprefixer: {
        browsers: ['last 3 versions'], 
        cascade: false
    },
    injectOptions: {
        //ignorePath: paths.app,
        addRootSlash: false
    },
      wiredep: { 
       // exclude: [/\/bootstrap\.js$/, /\/bootstrap\.css/],
        directory: paths.bower
    }
}

gulp.task('watch', ['styles', 'scripts', 'fonts', 'inject'], function () {
    gulp.watch(paths.src.root + 'index.html', ['inject']);
    gulp.watch(paths.src.sass + '*.scss', ['styles']);
    gulp.watch(paths.src.js+'*.js', ['scripts']);
   
});


gulp.task('styles', function(){

    return gulp.src(paths.src.sass + '*.scss')
    .pipe(sass(config.sassOptions))
    .pipe(plumber())
 //   .pipe(autoprefixer(config.autoprefixer))
    .pipe(gulp.dest(paths.dist.css))
    .pipe(browserSync.stream());
});

gulp.task('scripts', function () {

    return gulp.src([
        paths.src.js+'*.js',
        paths.bower+'jquery/dist/jquery.min.js',
        paths.bower+'bootstrap-sass/assets/javascripts/bootstrap.min.j',
    ])
    .pipe(gulp.dest(paths.dist.js))
    .pipe(browserSync.stream());
});


gulp.task('inject', ['scripts', 'styles'], function () {
  var injectStyles = gulp.src([

      paths.bower+'bootstrap/dist/css/bootstrap.min.css',
      paths.bower+'font-awesome/css/font-awesome.min.css',
      paths.dist.css + '*.css',
  ]);

  var injectScripts = gulp.src([
    paths.dist.js + '**/jquery.min.js',
    paths.dist.js + '**/bootstrap.min.js',
    paths.dist.js + '**/*.js'
  ]);
  
 
  return gulp.src(paths.src.root + 'index.html')

    .pipe(inject(injectStyles, config.injectOptions))
    .pipe(inject(injectScripts, config.injectOptions))
    .pipe(gulp.dest(paths.root));
});

gulp.task('fonts', function() {
   gulp.src(paths.bower + 'font-awesome/fonts/*.*')
    .pipe(gulp.dest(paths.dist.fonts));
});


gulp.task('default', ['styles', 'scripts', 'fonts', 'inject']);

gulp.task('serve', ['watch'], function () {
         browserSync.init({
            server: paths.root,
             open:true
    });
});