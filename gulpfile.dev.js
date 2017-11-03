const gulp   = require('gulp');
const watch  = require('gulp-watch');
const rename = require('gulp-rename');
const pump   = require('pump');
//@formatter:off
gulp.task('move-assets-exclude-css-js', function () {
    return gulp.src(['./raw/**', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.{css,js}'], {dot: true, base: './raw/'})
        .pipe(gulp.dest('./assets/'));
});

gulp.task('minify-js', function (cb) {
    pump([
            gulp.src(['./raw/**/*.js', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.min.js'], {dot: true, base: './raw/'})
                .pipe(rename({suffix: ".min", extname: ".js"})),
            gulp.dest('./assets/')
        ],
        cb
    );
});

gulp.task('minify-css', function () {
    return gulp.src(['./raw/**/*.css', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.min.css'], {dot: true, base: './raw/'})
        .pipe(rename({suffix: ".min", extname: ".css"}))
        .pipe(gulp.dest('./assets/'));
});

gulp.task('minify-html', function () {
    return gulp.src('./raw/views/**/*.{php,html}', {dot: true, base: './raw/views/'})
        .pipe(gulp.dest('./application/views/'));
});

gulp.task('watch-js', function (cb) {
    return watch(['./raw/**/*.js', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.min.js'], function (cb) {
        pump([
                gulp.src(['./raw/**/*.js', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.min.js'], {dot: true, base: './raw/'})
                    .pipe(rename({suffix: ".min", extname: ".js"})),
                gulp.dest('./assets/')
            ],
            cb
        );
    });
});

gulp.task('watch-css', function () {
    return watch(['./raw/**/*.css', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.min.css'], function () {
        return gulp.src(['./raw/**/*.css', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.min.css'], {dot: true, base: './raw/'})
            .pipe(rename({suffix: ".min", extname: ".css"}))
            .pipe(gulp.dest('./assets/'));
    });
});

gulp.task('watch-html', function () {
    return watch('./raw/views/**/*.{php,html}', function () {
        return gulp.src('./raw/views/**/*.{php,html}', {dot: true, base: './raw/views/'})
            .pipe(gulp.dest('./application/views/'));
    });
});
//@formatter:on
