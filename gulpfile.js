var gulp = require('gulp'),
	gutil = require('gulp-util'),
	sass = require('gulp-sass'),
	cssnano = require('gulp-cssnano'),
	autoprefixer = require('gulp-autoprefixer'),
	sourcemaps = require('gulp-sourcemaps'),
	rename = require('gulp-rename'),
	plumber = require('gulp-plumber');

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

gulp.task( 'copysocialfonts', function() {
	return gulp.src('./node_modules/social-logos/icon-font/**/*.{ttf,woff,woff2,eof,eot,svg}')
   .pipe(gulp.dest('./fonts'));
} );


gulp.task( 'watch', function() {
	
	// Watch font files
	gulp.watch( './node_modules/social-logos/icon-font/**/*.{ttf,woff,woff2,eof,eot,svg}', [ 'copysocialfonts' ] );
} );

gulp.task('default', function() {
  gulp.start( [ 'copysocialfonts', 'sass' ] );
});