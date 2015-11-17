// ==== FONTS ==== //

var gulp        = require('gulp')
  , plugins     = require('gulp-load-plugins')({ camelize: true })
  , config      = require('../../gulpconfig').fonts
;

// Copy changed images from the source folder to `build` (fast)
gulp.task('fonts', function() {
  return gulp.src(config.build.src)
  .pipe(plugins.changed(config.build.dest))
  .pipe(gulp.dest(config.build.dest));
});

// Optimize images in the `dist` folder (slow)
gulp.task('fonts-dist', function() {
  return gulp.src(config.dist.src)
  .pipe(gulp.dest(config.dist.dest));
});
