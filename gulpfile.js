'use strict';

const { src, dest, watch } = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync')
const uglify = require('gulp-uglify')
const minifyCss = require('gulp-clean-css')
const rename = require("gulp-rename")
const cached = require('gulp-cached')

const pathSrc = './src'
const pathDest = './assets'
const pathNodeModule = './node_modules'

// server
function server() {
    browserSync.init({
        proxy: "localhost/dakhoaquoctedanang",
        open: false,
        cors: true,
        ghostMode: false
    })
}

/*
Task build Bootstrap
* */

// Task build style bootstrap
function buildStylesBootstrap() {
    return src(`${pathSrc}/scss/bootstrap.scss`)
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathDest}/libs/bootstrap/`))
        .pipe(browserSync.stream());
}

// Task build js bootstrap
function buildLibsBootstrapJS() {
    return src([
        `${pathNodeModule}/bootstrap/dist/js/bootstrap.bundle.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathDest}/libs/bootstrap/`))
        .pipe(browserSync.stream());
}

exports.buildLibsBootstrapJS = buildLibsBootstrapJS

/*
Task build owl carousel
* */
function buildStylesOwlCarousel() {
    return src(`${pathNodeModule}/owl.carousel/dist/assets/owl.carousel.css`)
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathDest}/libs/owl.carousel/`))
        .pipe(browserSync.stream());
}

function buildJsOwlCarouse() {
    return src([
        `${pathNodeModule}/owl.carousel/dist/owl.carousel.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathDest}/libs/owl.carousel/`))
        .pipe(browserSync.stream());
}

// Task build style
function buildStylesTheme() {
    return src(`${pathSrc}/scss/style-theme.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathDest}/css/`))
        .pipe(browserSync.stream());
}

// Task build style elementor
function buildStylesElementor() {
    return src(`${pathSrc}/scss/elementor-addon/elementor-addon.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`./extension/elementor-addon/css/`))
        .pipe(browserSync.stream());
}

function buildJSElementor() {
    return src([
        `${pathSrc}/js/elementor-addon/*.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest('./extension/elementor-addon/js/'))
        .pipe(browserSync.stream());
}

// Task build style custom post type
function buildStylesCustomPostType() {
    return src(`${pathSrc}/scss/post-type/*/**.scss`)
        .pipe(cached('style-post-type'))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathDest}/css/post-type/`))
        .pipe(browserSync.stream());
}

// buildJSTheme
function buildJSTheme() {
    return src([
        `${pathSrc}/js/*.js`
    ], {allowEmpty: true})
        .pipe(cached('scripts'))
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathDest}/js/`))
        .pipe(browserSync.stream());
}

/*
Task build project
* */
async function buildProject() {
    await buildStylesBootstrap()
    await buildLibsBootstrapJS()

    await buildStylesOwlCarousel()
    await buildJsOwlCarouse()

    await buildStylesTheme()
    await buildJSTheme()

    await buildStylesCustomPostType()

    await buildStylesElementor()
    await buildJSElementor()
}
exports.buildProject = buildProject


// Task watch
function watchTask() {
    server()

    watch([
        `${pathSrc}/scss/variables-site/*.scss`,
        `${pathSrc}/scss/bootstrap.scss`
    ], buildStylesBootstrap)

    watch([
        `${pathSrc}/scss/variables-site/*.scss`,
        `${pathSrc}/scss/base/*.scss`,
        `${pathSrc}/scss/style.scss`,
    ], buildStylesTheme)

    watch([
        `${pathSrc}/scss/variables-site/*.scss`,
        `${pathSrc}/scss/elementor-addon/*.scss`
    ], buildStylesElementor)

    watch([
        `${pathSrc}/scss/variables-site/*.scss`,
        `${pathSrc}/scss/post-type/*/**.scss`
    ], buildStylesCustomPostType)

    watch([`${pathSrc}/js/*.js`], buildJSTheme)

    watch([
        `${pathSrc}/js/elementor-addon/*.js`
    ], buildJSElementor)

    watch([
        './*.php',
        './**/*.php',
        './assets/images/*/**.{png,jpg,jpeg,gif}'
    ], browserSync.reload);
}
exports.watchTask = watchTask