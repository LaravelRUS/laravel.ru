var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var prefix = require('gulp-autoprefixer');
var notify = require('gulp-notify');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var size = require('gulp-size');

gulp.task('default', ['styles']);

gulp.task('watch', function () {
	gulp.watch(' *** ', ['styles']);
});

gulp.task('styles', function () {
	var compressed = size();
	var gzipped = size({gzip: true});
	gulp.src(' *** ')
		.pipe(sass({
			outputStyle: 'compressed',
			precision: 10
		}))
		.on("error", notify.onError("<%= error.message %>"))
		.pipe(prefix('> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1'))
		.pipe(rename({
			dirname: "",
			suffix: ".min"
		}))
		.pipe(gulp.dest(' *** '))
		.pipe(compressed)
		.pipe(gzipped)
		.pipe(notify({
			onLast: true,
			title: "Styles compiled",
			message: function () {
				return compressed.prettySize + ' | ' + gzipped.prettySize;
			}
		}));
});

gulp.task('scripts', function () {
	var concatinated = size();
	var uglified = size();
	var gzipped = size({gzip: true});
	gulp.src([
		'vendor/bower_components/jquery/dist/jquery.js'
	])
		.pipe(concat('scripts.min.js'))
		.pipe(concatinated)
		.pipe(uglify())
		.pipe(uglified)
		.pipe(gulp.dest(' *** '))
		.pipe(gzipped)
		.pipe(notify({
			onLast: true,
			title: "JS scripts compiled",
			message: function () {
				return concatinated.prettySize + ' | ' + uglified.prettySize + ' | ' + gzipped.prettySize;
			}
		}));
});

gulp.task('font-awesome', function () {
	gulp.src('vendor/bower_components/fontawesome/fonts/**.*')
		.pipe(gulp.dest(' *** /fonts'))
		.pipe(notify("Font Awesome copied!"));
});