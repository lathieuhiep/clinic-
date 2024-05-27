'use strict';

const { src, dest, watch } = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync')
const uglify = require('gulp-uglify')
const minifyCss = require('gulp-clean-css')
const rename = require("gulp-rename")
const newer = require('gulp-newer');
const cached = require('gulp-cached');
const remember = require('gulp-remember');

const pathAssets = './assets'
const pathNodeModule = './node_modules'

// server
function server() {
    browserSync.init({
        proxy: "localhost/chuabenhtri.com.vn",
        open: false,
        cors: true,
        ghostMode: false,
        notify: false, // Tắt thông báo của BrowserSync
        injectChanges: true // Chỉ inject CSS thay vì reload toàn bộ trang
    })
}

/*
Task build Bootstrap
* */

// Task build style bootstrap
function buildStylesBootstrap() {
    return src(`${pathAssets}/scss/bootstrap.scss`)
        .pipe(newer(`${pathAssets}/libs/bootstrap/`))
        .pipe(cached('stylesBootstrap'))
        .pipe(sass({
            outputStyle: 'expanded'
        }).on('error', sass.logError))
        .pipe(remember('stylesBootstrap'))
        .pipe(minifyCss({
            compatibility: 'ie8',
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathAssets}/libs/bootstrap/`))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// Task build js bootstrap
function buildLibsBootstrapJS() {
    return src([
        `${pathNodeModule}/bootstrap/dist/js/bootstrap.bundle.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/bootstrap/`))
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
        }).on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/owl.carousel/`))
        .pipe(browserSync.stream());
}

function buildJsOwlCarouse() {
    return src([
        `${pathNodeModule}/owl.carousel/dist/owl.carousel.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/owl.carousel/`))
        .pipe(browserSync.stream());
}

// Task build style
function buildStylesTheme() {
    const destPath = `${pathAssets}/css/`;
    return src(`${pathAssets}/scss/style-theme.scss`)
        .pipe(newer(destPath))
        .pipe(cached('stylesTheme'))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(remember('stylesTheme'))
        .pipe(dest(destPath))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write())
        .pipe(dest(destPath))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// Task build style elementor
function buildStylesElementor() {
    const sourceFile = `${pathAssets}/scss/elementor-addon/elementor-addon.scss`;
    const destPath = './extension/elementor-addon/css/';

    return src(sourceFile)
        .pipe(newer(destPath))
        .pipe(cached('stylesElementor'))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(remember('stylesElementor'))
        .pipe(dest(destPath))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(destPath))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

function buildJSElementor() {
    return src([
        './extension/elementor-addon/js/*.js',
        '!./extension/elementor-addon/js/*.min.js'
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest('./extension/elementor-addon/js/'))
        .pipe(browserSync.stream());
}

// Task build style custom post type
function buildStylesCustomPostType() {
    const destPath = `${pathAssets}/css/post-type/`;
    return src(`${pathAssets}/scss/post-type/*/**.scss`)
        .pipe(newer(destPath))
        .pipe(cached('stylesCustomPostType'))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(remember('stylesCustomPostType'))
        .pipe(dest(destPath))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(destPath))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// buildJSTheme
function buildJSTheme() {
    return src([
        `${pathAssets}/js/*.js`,
        `!${pathAssets}/js/*.min.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathAssets}/js/`))
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

    browserSync.reload();
}
exports.buildProject = buildProject


// Task watch
function watchTask() {
    server();

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/bootstrap.scss`
    ], buildStylesBootstrap).on('change', function(path) {
        if (cached.caches['stylesBootstrap']) {
            delete cached.caches['stylesBootstrap'][path];
        }
        remember.forget('stylesBootstrap', path);
    });

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/base/*.scss`,
        `${pathAssets}/scss/style.scss`
    ], buildStylesTheme).on('change', function(path) {
        if (cached.caches['stylesTheme']) {
            delete cached.caches['stylesTheme'][path];
        }
        remember.forget('stylesTheme', path);
    });

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/elementor-addon/*.scss`
    ], buildStylesElementor).on('change', function(path) {
        if (cached.caches['stylesElementor']) {
            delete cached.caches['stylesElementor'][path];
        }
        remember.forget('stylesElementor', path);
    });

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/post-type/*/**.scss`
    ], buildStylesCustomPostType).on('change', function(path) {
        if (cached.caches['stylesCustomPostType']) {
            delete cached.caches['stylesCustomPostType'][path];
        }
        remember.forget('stylesCustomPostType', path);
    });

    watch([`${pathAssets}/js/*.js`, `!${pathAssets}/js/*.min.js`], buildJSTheme);

    watch([
        './extension/elementor-addon/js/*.js',
        '!./extension/elementor-addon/js/*.min.js'
    ], buildJSElementor);

    watch([
        './*.php',
        './**/*.php'
    ]).on('change', browserSync.reload);
}
exports.watchTask = watchTask;