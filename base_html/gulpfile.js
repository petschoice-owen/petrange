const sass = require('gulp-sass')(require('sass'));
var gulp = require('gulp'); 
var cssnano = require('gulp-cssnano'); 
var concat = require('gulp-concat'); 
var uglify = require('gulp-uglify');
 
gulp.task('sass', function(){    
    return gulp.src('scss/styles.scss')       
        .pipe(sass())       
        .pipe(cssnano({ zindex: false }))
        .pipe(gulp.dest('www/css')); 
});
gulp.task('js', function(){    
    return gulp.src(['js/plugins/*.js', 'js/*.js'])          
        .pipe(concat('all.js'))       
        .pipe(uglify())       
        .pipe(gulp.dest('www/js')); 
});
gulp.task('default', gulp.series('sass', 'js', (done) => {
  gulp.watch('**/*.scss', gulp.series('sass'));          
  gulp.watch('js/**/*.js', gulp.series('js')); 
  done();
}));
