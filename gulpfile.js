var gulp = require('gulp');
var watch = require('gulp-watch');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var pump = require('pump');

gulp.task('minify-js', function (cb)
{
    pump([
            gulp.src('raw/js/**/*.js').pipe(rename({
                suffix: ".min",
                extname: ".js"
            })),
            uglify(),
            gulp.dest('assets/js')
        ],
        cb
    );
});

gulp.task('watch-minify-js', function ()
{
    // Callback mode, useful if any plugin in the pipeline depends on the `end`/`flush` event
    return watch('raw/js/**/*.js', function (cb)
    {
        pump([
                gulp.src('raw/js/**/*.js').pipe(rename({
                    suffix: ".min",
                    extname: ".js"
                })),
                uglify(),
                gulp.dest('assets/js')
            ],
            cb
        );
    });
});

gulp.task('minify-css', function ()
{
    return gulp.src('raw/css/**/*.css')
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(rename({
            suffix: ".min",
            extname: ".css"
        }))
        .pipe(gulp.dest('assets/css'));
});
