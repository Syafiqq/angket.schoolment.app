var gulp = require('gulp');
var watch = require('gulp-watch');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var htmlmin = require('gulp-htmlmin');
var pump = require('pump');

gulp.task('minify-js', function (cb)
{
    pump([
            gulp.src(['./raw/**/*.js', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*.min.js'], {base: './raw/'}).pipe(rename({
                suffix: ".min",
                extname: ".js"
            })),
            uglify(),
            gulp.dest('./assets/')
        ],
        cb
    );
});

gulp.task('minify-css', function ()
{
    return gulp.src(['./raw/**/*.css', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*.min.css'], {base: './raw/'})
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(rename({
            suffix: ".min",
            extname: ".css"
        }))
        .pipe(gulp.dest('./assets/'));
});

gulp.task('minify-html', function ()
{
    return gulp.src('./raw/views/**/*.{php,html}', {base: './raw/views/'})
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest('./application/views/'));
});

gulp.task('move-assets-exclude-css-js', function ()
{
    return gulp.src(['./raw/**', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*(*.css|*.js)'], {base: './raw/'})
        .pipe(gulp.dest('./assets/'));
});

gulp.task('watch-minify-js', function ()
{
    // Callback mode, useful if any plugin in the pipeline depends on the `end`/`flush` event
    return watch(['./raw/**/*.js', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*.min.js'], function (cb)
    {
        pump([
                gulp.src(['./raw/**/*.js', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*.min.js'], {base: './raw/'}).pipe(rename({
                    suffix: ".min",
                    extname: ".js"
                })),
                uglify(),
                gulp.dest('./assets/')
            ],
            cb
        );
    });
});

gulp.task('watch-minify-css', function ()
{
    // Callback mode, useful if any plugin in the pipeline depends on the `end`/`flush` event
    return watch(['./raw/**/*.css', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*.min.css'], function ()
    {
        return gulp.src(['./raw/**/*.css', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*.min.css'], {base: './raw/'})
            .pipe(cleanCSS({compatibility: 'ie8'}))
            .pipe(rename({
                suffix: ".min",
                extname: ".css"
            }))
            .pipe(gulp.dest('./assets/'));
    });
});

gulp.task('watch-minify-html', function ()
{
    // Callback mode, useful if any plugin in the pipeline depends on the `end`/`flush` event
    return watch('./raw/views/**/*.{php,html}', function ()
    {
        return gulp.src('./raw/views/**/*.{php,html}', {base: './raw/views/'})
            .pipe(htmlmin({collapseWhitespace: true}))
            .pipe(gulp.dest('./application/views/'));
    });
});

gulp.task('watch-move-assets-exclude-css-js', function ()
{
    // Callback mode, useful if any plugin in the pipeline depends on the `end`/`flush` event
    return watch(['./raw/**', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*(*.css|*.js)'], function ()
    {
        return gulp.src(['./raw/**', '!./raw/{link,link/**,views,views/**}', '!./raw/**/*(*.css|*.js)'], {base: './raw/'})
            .pipe(gulp.dest('./assets/'));
    });
});