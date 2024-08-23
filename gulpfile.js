import gulp from "gulp";
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass';

const sass = gulpSass(dartSass);
import gulpAutoprefixer from "gulp-autoprefixer";
import cleanCss from "gulp-clean-css";
import browserSync from "browser-sync";
import concat from 'gulp-concat';
import uglify from 'gulp-uglify';
const src_folder = './assets/';

gulp.task('browser-sync', function () {
  browserSync.init({
    proxy: "rose.loc",
    notify: false,
  });
});

gulp.task('styles', function () {
  return gulp.src(src_folder + 'sass/style.sass', {
    allowEmpty: true
  })
    .pipe(sass({}).on('error', sass.logError))
    .pipe(gulpAutoprefixer({
      overrideBrowserslist: ['last 10 versions']
    }))
    .pipe(cleanCss())
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream());
});


gulp.task('scripts', function () {
  return gulp.src([
    src_folder + 'js/main.js'
  ], {
    allowEmpty: true
  })
    .pipe(concat('main.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./'))
    .pipe(browserSync.reload({stream: true}));
});

gulp.task('code', function () {
    return browserSync.reload({stream: true})
});

gulp.task('watch', function () {
    gulp.watch(src_folder + 'sass/**/*.*', gulp.parallel('styles'));
    gulp.watch(src_folder + 'js/**/*.js', gulp.parallel('scripts'));
    gulp.watch('./**/*.php').on('change', browserSync.reload);
});

gulp.task('default', gulp.parallel('browser-sync', 'watch'));
