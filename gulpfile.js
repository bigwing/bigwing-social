var gulp = require('gulp'),
	gutil = require('gulp-util'),
	sass = require('gulp-sass'),
	cssnano = require('gulp-cssnano'),
	autoprefixer = require('gulp-autoprefixer'),
	sourcemaps = require('gulp-sourcemaps'),
	rename = require('gulp-rename'),
	plumber = require('gulp-plumber'),
	phplint = require('phplint')

gulp.task('default', function() {
  // place code for your default task here
});

gulp.task( 'sass', function() {
	return gulp.src('./css/sass/**/*.scss')
		.pipe(plumber(function(error) {
			gutil.log(gutil.colors.red(error.message));
			this.emit('end');
		}))
		.pipe(sourcemaps.init())
		.pipe(sass({ 
			style: 'compressed',
			sourceComments: false
		}))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(rename({suffix: '.min'}))
		.pipe(cssnano())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./css/'));
} );

gulp.task( 'copysocialsvg', function() {
	return gulp.src('./node_modules/social-logos/svg-sprite/social-logos.svg')
   .pipe(gulp.dest('./images'));
} );

gulp.task('phplint', function (cb) {
	phplint(['./**/*.php', '!node_modules/**/*', '!vendor/**/*'],  { limit: 10 }, 
		function (err, stdout, stderr) {
			if (err) {
				cb(err);
			} else {
				cb();
			}
		}
	);
});


gulp.task( 'watch', function() {
	
	// Watch SASS files
	gulp.watch( './css/sass/**/*.scss', [ 'sass' ] );
	
	// Watch font files
	gulp.watch( './node_modules/social-logos/svg-sprite/social-logos.svg', [ 'copysocialsvg' ] );
} );

gulp.task('default', function() {
  gulp.start( [ 'copysocialsvg', 'sass' ] );
});