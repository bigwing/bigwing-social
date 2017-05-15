var gulp = require('gulp');

gulp.task('default', function() {
  // place code for your default task here
});

gulp.task( 'copysocialfonts', function() {
	return gulp.src('./node_modules/social-logos/icon-font/**/*.{ttf,woff,woff2,eof,eot,svg}')
   .pipe(gulp.dest('./fonts'));
} );


gulp.task( 'watch', function() {
	
	// Watch font files
	gulp.watch( './node_modules/social-logos/icon-font/**/*.{ttf,woff,woff2,eof,eot,svg}', [ 'copysocialfonts' ] );
} );

gulp.task('default', function() {
  gulp.start( 'copysocialfonts' );
});