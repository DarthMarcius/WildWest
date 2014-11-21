var gulp = require("gulp"),
	livereload = require("gulp-livereload"),
	rubySass = require("gulp-ruby-sass");
  jsMinifier = require("gulp-uglify")
  rename = require('gulp-rename');

var paths = {
  sass: "../css/sass/main.min.scss",
  sassWatchPath: "../css/sass/**/*.scss",
  cssWatchPath: "../css/*.css",
  sassOut: "../css",
  cssOut: "../css",
  sourcemapPath: "../css",
  jsPath: "custom/*.js",
  jsOut: "custom/compressed"
};

gulp.task("compressSass", function() {
  return gulp.src(paths.sass)
        .pipe(rubySass({style: 'compressed', sourcemapPath: paths.sourcemapPath}))
        .on('error', function (err) { console.log(err.message); })
        .pipe(gulp.dest(paths.sassOut))
        .pipe(livereload());
});

gulp.task('compressJs', function() {
  gulp.src(paths.jsPath)
    .pipe(jsMinifier())
    .pipe(rename({ suffix: '.min'}))
    .pipe(gulp.dest(paths.jsOut))
    .pipe(livereload())
});

gulp.task('compressRequireJS', function() {
  gulp.src("bower_components/requirejs/require.js")
    .pipe(jsMinifier())
    .pipe(rename({ suffix: '.min'}))
    .pipe(gulp.dest("bower_components/requirejs"))
    .pipe(livereload())
});

gulp.task('compressBackbone', function() {
  gulp.src("bower_components/backbone/backbone.js")
    .pipe(jsMinifier())
    .pipe(rename({ suffix: '.min'}))
    .pipe(gulp.dest("bower_components/backbone"))
    .pipe(livereload())
});

gulp.task('compressRequireConfig', function() {
  gulp.src("*config.js")
    .pipe(jsMinifier())
    .pipe(rename({ suffix: '.min'}))
    .pipe(gulp.dest("."))
    .pipe(livereload())
});


gulp.task('watch', function() {
  gulp.watch("*config.js", ['compressRequireConfig']);
  gulp.watch(paths.sassWatchPath, ['compressSass']);
  gulp.watch(paths.jsPath, ['compressJs']);
});

gulp.task('default', ['compressRequireJS', 'compressRequireConfig', 'compressBackbone', 'compressSass', 'compressJs', 'watch']);