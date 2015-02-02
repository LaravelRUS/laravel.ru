var gulp = require('gulp'),
	sass = require('gulp-sass'),
	concat = require('gulp-concat'),
	prefix = require('gulp-autoprefixer'),
	notify = require('gulp-notify'),
	rename = require('gulp-rename'),
	uglify = require('gulp-uglify'),
	size = require('gulp-size'),
	replace = require('gulp-replace'),

	paths = {
		bower: 'vendor/bower_components/'
	};

gulp.task('default', ['styles', 'scripts', 'font-awesome']);

gulp.task('watch', function () {
	gulp.watch('resources/scss/**/*.scss', ['styles']);
	gulp.watch('resources/js/*.js', ['scripts']);
});

gulp.task('styles', function () {
	var compressed = size();
	var gzipped = size({gzip: true});
	gulp.src('resources/scss/**/*.scss')
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
		.pipe(replace(/\/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+\//g, ''))
		.pipe(gulp.dest('public/css'))
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
		paths.bower + 'jquery/dist/jquery.js',
		paths.bower + 'sweetalert/lib/sweet-alert.js',
		paths.bower + 'google-code-prettify/bin/prettify.min.js',
		'resources/js/*.js'
	])
		.pipe(concat('script.min.js'))
		.pipe(concatinated)
		.pipe(uglify())
		.on("error", notify.onError("<%= error.message %>"))
		.pipe(uglified)
		.pipe(gulp.dest('public/js'))
		.pipe(gzipped)
		.pipe(notify({
			onLast: true,
			title: "Scripts compiled",
			message: function () {
				return concatinated.prettySize + ' | ' + uglified.prettySize + ' | ' + gzipped.prettySize;
			}
		}));
});

gulp.task('font-awesome', function () {
	gulp.src('vendor/bower_components/fontawesome/fonts/**.*')
		.pipe(gulp.dest('public/fonts'))
		.pipe(notify({
			onLast: true,
			title: "Font Awesome copied!",
			message: 'Success!'
		}));
});