'use strict';

var gulp    = require('gulp');
var sass    = require('gulp-sass');
var concat  = require('gulp-concat');
var uglify  = require('gulp-uglify');
var cleanCSS = require('gulp-clean-css'); // minify css
var autoprefixer = require('gulp-autoprefixer');
var compass = require('gulp-compass');

var dir = {
    assets: './src/AppBundle/Resources/',
    dist: './web/',
    npm: './node_modules/',
};

// use compass to compile sass to css then minify and concatenate to style.css
gulp.task('css', function(){
    return gulp.src([
        dir.assets + 'style/**/*.css'
    ])
        .pipe(concat('style.css'))
        .pipe(cleanCSS())
        // .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(gulp.dest(dir.dist + 'css'));
});

gulp.task('compass', function() {
     return gulp.src(dir.assets  + 'style/sass/**/*.scss')
        .pipe(compass({
            config_file: 'config.rb',
            css: dir.assets  + 'style',
            sass: dir.assets  + 'style/sass'
        }))
        .on('error', function(error) {
            console.log(error);
            this.emit('end');
        })
    .pipe(gulp.dest('./src/AppBundle/Resources/style'));
});

gulp.task('scripts', function() {
    gulp.src([
        //Third party assets
            dir.npm + 'jquery/dist/jquery.min.js',
            dir.npm + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',

            dir.assets + 'scripts/*.js',
            dir.assets + 'scripts/vendors/jquery.1.11.js'

        ])
        .pipe(concat('script.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dir.dist + 'js'));
});

gulp.task('images', function() {
    gulp.src([
            dir.assets + 'images/**'
        ])
        .pipe(gulp.dest(dir.dist + 'images'));
});

gulp.task('fonts', function() {
    gulp.src([
        dir.assets + 'fonts/**'
        ])
        .pipe(gulp.dest(dir.dist + 'fonts'));
});

gulp.task('default', ['css', 'scripts', 'fonts', 'images']);

gulp.task('watch-css', function () {
    gulp.watch('src/AppBundle/Resources/style/**/*.css', ['css' ]);
});
