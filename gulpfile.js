let argv = require('minimist')(process.argv.slice(2));
let {parallel, series, src, dest} = require('gulp');
let sass = require('gulp-sass');
let autoprefixer = require('gulp-autoprefixer');
let uglify = require('gulp-uglify');
let changed = require('gulp-changed');
let imagemin = require('gulp-imagemin');
// let jshint = require('gulp-jshint');
let gulpif = require('gulp-if');
let lazypipe = require('lazypipe');
let cleanCSS  = require('gulp-clean-css');
let browserSync = require('browser-sync').create();
let concat = require('gulp-concat');
let flatten = require('gulp-flatten');
let svgmin = require('gulp-svgmin');
let sourcemaps = require('gulp-sourcemaps');
let del = require('del');

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
async function styles(){
    return src('resources/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            overrideBrowserslist: AUTOPREFIXER_BROWSERS,
            cascade: false
        }))
        .pipe(sass({
            outputStyle: 'compressed',
        }))
        .pipe(sourcemaps.write('.', {
            sourceRoot: 'public/css/'
        }))
        .pipe(dest('public/css/'),{ sourcemaps: '.' })
        .pipe(browserSync.stream());
}

//Image minify
async function imagemins(){
    let imgSrc = 'assets/images/*.+(png|jpg|gif)',
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
async function clean(cb){
    return del(['./dist'], cb);
}

// `gulp fonts` - Grabs all the fonts and outputs them in a flattened directory
// structure. See: https://github.com/armed/gulp-flatten
async function fonts() {
    return src('assets/fonts/*')
        .pipe(flatten())
        .pipe(dest('./dist/fonts'))
        .pipe(browserSync.stream());
};

//My libraries
let JAVASCRIPT_LIBRARIES = [
    'public/js/jquery-3.4.0.min.js',
    'public/js/moment.min.js',
    'public/js/bootstrap.min.js',
    'public/js/daterangepicker.min.js',
    'public/js/daterangepickerjquery.js',
    'public/js/animate.js',
    'public/js/script.js',
];
async function scripts(){
    return src(JAVASCRIPT_LIBRARIES)
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(dest('./public/js/'))
        .pipe(browserSync.stream());
}

// ### Gulp
// `gulp` - Run a complete build. To compile for production run `gulp --production`.
// exports.fonts = fonts;
// exports.imagemins = imagemins;
exports.scripts = scripts;
exports.styles = styles;
// exports.clean = clean;
// exports.build = series(styles, scripts, imagemins, fonts);
// exports.default = series(clean, parallel(styles, scripts, imagemins, fonts));
