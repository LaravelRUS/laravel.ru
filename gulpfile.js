var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var prefix = require('gulp-autoprefixer');
var notify = require('gulp-notify');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var size = require('gulp-size');

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
		'vendor/bower_components/jquery/dist/jquery.js',
		'vendor/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/collapse.js',
		'vendor/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/transition.js',
		'vendor/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/dropdown.js'
	])
		.pipe(concat('script.min.js'))
		.pipe(concatinated)
		//.pipe(uglify())
		//.pipe(uglified)
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