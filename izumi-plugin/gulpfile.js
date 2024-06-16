// Load Gulp...of course
import gulp from 'gulp';

// CSS related plugins
// import sass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import minifycss from 'gulp-uglifycss';

// JS related plugins
import concat from 'gulp-concat';
import uglify from 'gulp-uglify';
import babelify from 'babelify';
import browserify from 'browserify';
import source from 'vinyl-source-stream';
import buffer from 'vinyl-buffer';
import stripDebug from 'gulp-strip-debug';

// Utility plugins
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';
import notify from 'gulp-notify';
import plumber from 'gulp-plumber';
import options from 'gulp-options';
import gulpif from 'gulp-if';

// Browers related plugins
import browserSyncPackage from 'browser-sync';
const browserSync = browserSyncPackage.create();
const reload = browserSync.reload;
import gulpSass from 'gulp-sass';
import * as sassWithNode from 'sass';
const sass = gulpSass(sassWithNode);

// Project related variables
var projectURL   = 'https://test.dev';

var styleSRC     = './src/scss/mystyle.scss';
var styleURL     = './assets/';
var mapURL       = './';

var jsSRC        = './src/js/myscript.js';
var jsURL        = './assets/';

var styleWatch   = './src/scss/**/*.scss';
var jsWatch      = './src/js/**/*.js';
var phpWatch     = './**/*.php';

function browserSyncTask(done) {
    browserSync.init({
        proxy: projectURL,
        injectChanges: true,
        open: false
    });
    done();
}

function styles() {
    return gulp.src( styleSRC )
        .pipe( sourcemaps.init() )
        .pipe( sass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }) )
        .on( 'error', console.error.bind( console ) )
        .pipe( autoprefixer() )
        .pipe( sourcemaps.write( mapURL ) )
        .pipe( gulp.dest( styleURL ) )
        .pipe( browserSync.stream() );
}

function js() {
    return browserify({
        entries: [jsSRC]
    })
        .transform( babelify, { presets: [ 'env' ] } )
        .bundle()
        .pipe( source( 'myscript.js' ) )
        .pipe( buffer() )
        .pipe( gulpif( options.has( 'production' ), stripDebug() ) )
        .pipe( sourcemaps.init({ loadMaps: true }) )
        .pipe( uglify() )
        .pipe( sourcemaps.write( '.' ) )
        .pipe( gulp.dest( jsURL ) )
        .pipe( browserSync.stream() );
}

function triggerPlumber( src, url ) {
    return gulp.src( src )
        .pipe( plumber() )
        .pipe( gulp.dest( url ) );
}

function defaultTask(done) {
    gulp.src( jsURL + 'myscript.min.js' )
        .pipe( notify({ message: 'Assets Compiled!' }) );
    done();
}

function watch(done) {
    gulp.watch( phpWatch, reload );
    gulp.watch( styleWatch, styles );
    gulp.watch( jsWatch, gulp.series(js, reload) );
    gulp.src( jsURL + 'myscript.min.js' )
        .pipe( notify({ message: 'Gulp is Watching, Happy Coding!' }) );
    done();
}

gulp.task('browser-sync', browserSyncTask);
gulp.task('styles', styles);
gulp.task('js', js);
gulp.task('default', gulp.series('styles', 'js', defaultTask));
gulp.task('watch', gulp.series('default', 'browser-sync', watch));
