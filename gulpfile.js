var argv = require('minimist')(process.argv.slice(2));
var {parallel, series, src, dest} = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var changed = require('gulp-changed');
var imagemin = require('gulp-imagemin');
var jshint = require('gulp-jshint');
var gulpif = require('gulp-if');
var lazypipe = require('lazypipe');
var cleanCSS  = require('gulp-clean-css');
var browserSync = require('browser-sync').create();
var concat = require('gulp-concat');
var flatten = require('gulp-flatten');
var svgmin = require('gulp-svgmin');
var sourcemaps = require('gulp-sourcemaps');
var del = require('del');

const AUTOPREFIXER_BROWSERS = [
  'ie >= 10',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 7',
  'android >= 4.4',
  'bb >= 10'
];

const AUTOPREFIXER_BROWSERS_OLDER = [
  'last 2 versions',
  'android 4',
  'opera 12'
];

//Styles task
function styles(){
    return src('assets/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            overrideBrowserslist: AUTOPREFIXER_BROWSERS,
            cascade: false
        }))
        .pipe(sass({
            outputStyle: 'compressed',
        }))
        .pipe(sourcemaps.write('.', {
            sourceRoot: 'assets/sass/'
        }))
        .pipe(dest('./dist/css'),{ sourcemaps: '.' })
        .pipe(browserSync.stream());
}

//Image minify
function imagemins(){
    var imgSrc = 'assets/images/*.+(png|jpg|gif)',
        imgDst = './dist/images';
    return src(imgSrc)
        .pipe(imagemin({
            progressive: true,
            interlaced: true,
            svgoPlugins: [{removeUnknownsAndDefaults: false}, {cleanupIDs: true}]
        }))
        //gulp.src(imgSrc)
        .pipe(changed(imgDst))
        .pipe(imagemin())
        .pipe(dest(imgDst))
        .pipe(dest(imgDst));
}

// `gulp clean` - Deletes the build folder entirely.
function clean(cb){
    return del(['./dist'], cb);
}

// `gulp fonts` - Grabs all the fonts and outputs them in a flattened directory
// structure. See: https://github.com/armed/gulp-flatten
function fonts() {
    return src('assets/fonts/*')
        .pipe(flatten())
        .pipe(dest('./dist/fonts'))
        .pipe(browserSync.stream());
};

//My libraries
var JAVASCRIPT_LIBRARIES = [
    'assets/js/bootstrap3.7.min.js',
    'assets/js/script.js'
];
function scripts(){
    return src(JAVASCRIPT_LIBRARIES)
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(dest('./dist/js'))
        .pipe(browserSync.stream());
}

// ### Gulp
// `gulp` - Run a complete build. To compile for production run `gulp --production`.

exports.fonts = fonts;
exports.imagemins = imagemins;
exports.scripts = scripts;
exports.styles = styles;
exports.clean = clean;
exports.build = series(styles, scripts, imagemins, fonts);
exports.default = series(clean, parallel(styles, scripts, imagemins, fonts));