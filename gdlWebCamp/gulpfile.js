const { src, dest, watch , parallel } = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('autoprefixer');
const postcss    = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin');
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const webp = require('gulp-webp');

const paths = {
    scss: 'src/scss/frontend/**/*.scss',
    js: 'src/js/frontend/**/*.js',
    imagenes: 'src/img/**/*',
    adminscss: 'src/scss/backend/**/*.scss',
    adminjs: 'src/js/backend/**/*.js'
}

// css es una función que se puede llamar automaticamente
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe( dest('./public/build/css') );
}

function admincss() {
    return src(paths.adminscss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe( dest('./public/build/css') );
}

function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js')) // final output file name
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./public/build/js'))
}

function adminJavascript() {
    return src(paths.adminjs)
      .pipe(sourcemaps.init())
      .pipe(concat('admin.js')) // final output file name
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./public/build/js'))
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3})))
        .pipe(dest('./public/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe( webp() )
        .pipe(dest('./public/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}


function watchArchivos() {
    watch( paths.scss, css );
    watch( paths.adminscss, admincss );
    watch( paths.js, javascript );
    watch( paths.adminjs, adminJavascript );
    watch( paths.imagenes, imagenes );
    //watch( paths.imagenes, versionWebp );
}
  
//exports.default = parallel(css, javascript,  imagenes, versionWebp, watchArchivos ); 

exports.default = parallel(css, admincss, javascript, adminJavascript, imagenes, watchArchivos ); // Tuve que quitar webp porque no es compatible con windows 7