'use strict';

const { src, dest, watch } = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync')
const uglify = require('gulp-uglify')
const minifyCss = require('gulp-clean-css')
const rename = require("gulp-rename")

const pathSrc = './src'
const pathDist  = './assets'
const pathNodeModule = './node_modules'

// server
const proxy = "localhost/yhocquoctecantho.vn"
function server() {
    browserSync.init({
        proxy: proxy,
        open: false,
        cors: true,
        ghostMode: false,
        notify: false,
        injectChanges: true
    })
}

// function build style
const buildStyleLib = (rootPath, distPath) => {
    return src( rootPath )
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest( distPath ))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// function build style has map
const buildStyleHasMap = (rootPath, distPath) => {
    return src( rootPath )
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest( distPath ))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

// function build js
const buildJsLib = (rootPath, distPath) => {
    return src( rootPath, {allowEmpty: true} )
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest( distPath ))
        .pipe(browserSync.stream())
}

/*
Task build Bootstrap
* */

// Task build style bootstrap
const buildStylesBootstrap = () => {
    buildStyleLib( `${pathSrc}/scss/bootstrap.scss`, `${pathDist}/libs/bootstrap/` )
}

// Task build js bootstrap
const buildLibsBootstrapJS = () => {
    buildJsLib( `${pathNodeModule}/bootstrap/dist/js/bootstrap.bundle.js`, `${pathDist}/libs/bootstrap/` )
}

/*
Task build owl carousel
* */

// Task build style owl carousel
const buildStylesOwlCarousel = () => {
    buildStyleLib( `${pathNodeModule}/owl.carousel/dist/assets/owl.carousel.css`, `${pathDist}/libs/owl.carousel/` )
}

// Task build js owl carousel
const buildJsOwlCarouse = () => {
    buildJsLib( `${pathNodeModule}/owl.carousel/dist/owl.carousel.js`, `${pathDist}/libs/owl.carousel/` )
}

// Task build style
const buildStylesTheme = () => {
    return src( `${pathSrc}/scss/style-theme.scss` )
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest( `${pathDist}/css/` ))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

// Task build style elementor
const buildStylesElementor = () => {
    buildStyleHasMap(`${pathSrc}/scss/elementor-addon/elementor-addon.scss`, './extension/elementor-addon/css/' )
}

const buildJSElementor = () => {
    buildJsLib( `${pathSrc}/js/elementor-addon/*.js`, './extension/elementor-addon/js/' )
}

// Task build style custom post type
const buildStylesCustomPostType = () => {
    buildStyleHasMap(`${pathSrc}/scss/post-type/*/**.scss`, `${pathDist}/css/post-type/` )
}

// Task build style page templates
const buildStylesPageTemplate = () => {
    buildStyleHasMap(`${pathSrc}/scss/page-templates/**.scss`, `${pathDist}/css/page-templates/` )
}

// buildJSTheme
const buildJSTheme = () => {
    buildJsLib( `${pathSrc}/js/*.js`, `${pathDist}/js/` )
}

/*
Task build project
* */
const buildProject = async () => {
    await buildStylesBootstrap()
    await buildLibsBootstrapJS()

    await buildStylesOwlCarousel()
    await buildJsOwlCarouse()

    await buildStylesTheme()
    await buildJSTheme()

    await buildStylesCustomPostType()
    await buildStylesPageTemplate()

    await buildStylesElementor()
    await buildJSElementor()

    browserSync.reload()
}
exports.buildProject = buildProject


// Task watch
const watchTask = () => {
    server()

    watch([
        `${pathSrc}/scss/variables-site/*.scss`,
        `${pathSrc}/scss/bootstrap.scss`
    ], buildStylesBootstrap)

    watch([
        `${pathSrc}/scss/variables-site/*.scss`,
        `${pathSrc}/scss/base/*.scss`,
        `${pathSrc}/scss/style-theme.scss`,
    ], buildStylesTheme)

    watch([
        `${pathSrc}/scss/variables-site/*.scss`,
        `${pathSrc}/scss/elementor-addon/*.scss`
    ], buildStylesElementor)

    watch([
        `${pathSrc}/scss/variables-site/*.scss`,
        `${pathSrc}/scss/post-type/*/**.scss`
    ], buildStylesCustomPostType)

    watch([
        `${pathSrc}/js/*.js`
    ], buildJSTheme)

    watch([
        `${pathSrc}/js/elementor-addon/*.js`
    ], buildJSElementor)

    watch([
        './*.php',
        './**/*.php',
        `${pathDist}/images/*`,
        `${pathDist}/images/**/*`
    ]).on('change', browserSync.reload);
}
exports.watchTask = watchTask