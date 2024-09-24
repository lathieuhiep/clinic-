'use strict';

const { src, dest, watch, series } = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync')
const uglify = require('gulp-uglify')
const minifyCss = require('gulp-clean-css')
const rename = require("gulp-rename")
const cached = require('gulp-cached')

const pathSrc = './src'
const pathDist  = './assets'
const pathNodeModule = './node_modules'

// server
const proxy = "localhost/namkhoa199"
function server() {
    browserSync.init({
        proxy: proxy,
        open: 'local',
        cors: true,
        ghostMode: false
    })
}

/*
Task build Bootstrap
* */

// Task build style bootstrap
const buildStylesBootstrap = () => {
    return src(`${pathSrc}/scss/vendors/bootstrap.scss`)
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathDist}/libs/bootstrap/`))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

// Task build js bootstrap
const buildLibsBootstrapJS = () => {
    return src( `${pathNodeModule}/bootstrap/dist/js/bootstrap.bundle.js`, {allowEmpty: true} )
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathDist}/libs/bootstrap/`))
        .pipe(browserSync.stream())
}

// Task build fontawesome
function buildFontawesomeStyle() {
    return src(`${pathSrc}/scss/vendors/fontawesome.scss`)
        .pipe(sass({
            outputStyle: 'expanded',
            includePaths: ['node_modules']
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathDist}/libs/fontawesome/css`))
        .pipe(browserSync.stream())
}

function copyWebFonts() {
    return src([
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-brands-400.ttf',
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-brands-400.woff2',
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.ttf',
        './node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff2'
    ], {encoding: false})
        .pipe(dest(`${pathDist}/libs/fontawesome/webfonts`))
        .pipe(browserSync.stream())
}

// Task build style
const buildStylesTheme = () => {
    return src( `${pathSrc}/scss/style-theme.scss` )
        // .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        // .pipe(sourcemaps.write())
        .pipe(dest( `${pathDist}/css/` ))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

// Task build style elementor
const buildStylesElementor = () => {
    return src(`${pathSrc}/scss/elementor-addon/elementor-addon.scss`)
        // .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        // .pipe(sourcemaps.write())
        .pipe(dest('./extension/elementor-addon/css/'))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

const buildJSElementor = () => {
    return src(`${pathSrc}/js/elementor-addon/*.js`, {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest('./extension/elementor-addon/js/'))
        .pipe(browserSync.stream())
}

// Task build style custom post type
const buildStylesCustomPostType = () => {
    return src(`${pathSrc}/scss/post-type/*/**.scss`)
        .pipe(cached('buildStylesCustomPostType'))
        // .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        // .pipe(sourcemaps.write())
        .pipe(dest(`${pathDist}/css/post-type/`))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

// Task build style page templates
const buildStylesPageTemplate = () => {
    return src(`${pathSrc}/scss/page-templates/**.scss`)
        // .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }, '').on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        // .pipe(sourcemaps.write())
        .pipe(dest(`${pathDist}/css/page-templates/`))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

// buildJSTheme
const buildJSTheme = () => {
    return src(`${pathSrc}/js/*.js`, {allowEmpty: true})
        .pipe(cached('buildJSTheme'))
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathDist}/js/`))
        .pipe(browserSync.stream())
}

/*
Task build project
* */
const buildProject = async () => {
    await buildStylesBootstrap()
    await buildLibsBootstrapJS()

    await buildFontawesomeStyle()
    await copyWebFonts()

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
    ], series(
        buildStylesBootstrap,
        buildStylesTheme,
        buildStylesElementor,
        buildStylesCustomPostType,
        buildStylesPageTemplate
    ))

    watch([
        `${pathSrc}/scss/vendors/bootstrap.scss`
    ], buildStylesBootstrap)

    watch([
        `${pathSrc}/scss/base/*.scss`,
        `${pathSrc}/scss/style-theme.scss`
    ], buildStylesTheme)

    watch([
        `${pathSrc}/scss/elementor-addon/*.scss`
    ], buildStylesElementor)

    watch([
        `${pathSrc}/scss/post-type/*/**.scss`
    ], buildStylesCustomPostType)

    watch([
        `${pathSrc}/scss/page-templates/**.scss`
    ], buildStylesPageTemplate)

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