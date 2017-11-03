const gulp     = require('gulp');
const cleanCSS = require('gulp-clean-css');
const rename   = require('gulp-rename');
const uglify   = require('gulp-uglify');
const htmlmin  = require('gulp-htmlmin');
const pump     = require('pump');

//@formatter:off
gulp.task('move-assets-exclude-css-js', function () {
    return gulp.src(['./raw/**', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.{css,js}'], {dot: true, base: './raw/'})
        .pipe(gulp.dest('./assets/'));
});

gulp.task('minify-js', function (cb) {
    pump([
            gulp.src(['./raw/**/*.js', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.min.js'], {dot: true, base: './raw/'})
                .pipe(rename({suffix: ".min", extname: ".js"})),
            uglify(),
            gulp.dest('./assets/')
        ],
        cb
    );
});

gulp.task('minify-css', function () {
    return gulp.src(['./raw/**/*.css', '!./raw/link/**', '!./raw/views/**', '!./raw/**/*.min.css'], {dot: true, base: './raw/'})
        .pipe(cleanCSS({compatibility: 'ie8', rebase: false}))
        .pipe(rename({suffix: ".min", extname: ".css"}))
        .pipe(gulp.dest('./assets/'));
});

gulp.task('minify-html', function () {
    return gulp.src('./raw/views/**/*.{php,html}', {dot: true, base: './raw/views/'})
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest('./application/views/'));
});
//@formatter:on
