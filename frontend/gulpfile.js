// Load plugins
const gulp = require('gulp');
const { src, dest, watch, parallel, series } = require("gulp");
const sass = require('gulp-sass')(require('sass'));
const ejs = require("gulp-ejs");
const rename = require("gulp-rename");
const sync = require("browser-sync").create();
const eslint = require("gulp-eslint");
const imagemin = ('gulp-imagemin');
var nunjucksRender = require('gulp-nunjucks-render');
const concat = require('gulp-concat');
const cleanCss = require('gulp-clean-css');
const minifyJs = require('gulp-minify');

// run gulp sync for live changes
gulp.task('images', function () {
	return gulp.src([
		'./frontend/img/*.jpg',
		'./frontend/img/*.png',
		'./frontend/img/*.gif',
		'./frontend/img/*.pdf',
		'./frontend/img/*.svg',
		'./frontend/img/*.ico'
	])
		.pipe(gulp.dest('./frontend/dist/img'))
		.pipe(gulp.dest('./site/app/webroot/img'));
});

gulp.task('nunjucks', function () {
	// Folder with files to minify
	return gulp.src('public/stylesheets/*.css')
		//The method pipe() allow you to chain multiple tasks together 
		//I execute the task to minify the files
		.pipe(cleanCSS())
		//I define the destination of the minified files with the method dest
		.pipe(gulp.dest('dist'));
});


// gulp.task('minifycss', () => {
// 	// Folder with files to minify
// 	return gulp.src('public/stylesheets/*.css')
// 		//The method pipe() allow you to chain multiple tasks together 
// 		//I execute the task to minify the files
// 		.pipe(cleanCSS())
// 		//I define the destination of the minified files with the method dest
// 		.pipe(gulp.dest('public/css'));
// });



function njkToHtml(cb) {
	return gulp.src('frontend/html/pages/**/*.+(html|nunjucks|njk)')
		.pipe(nunjucksRender({
			path: ['frontend/html/pages']
		}))
		.pipe(gulp.dest('public'));
}


function generateCSS(cb) {
	src('frontend/sass/**/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(dest('public/stylesheets'))
		.pipe(sync.stream())
		.pipe(cleanCss())
		.pipe(concat('main.css'))
		//I define the destination of the minified files with the method dest
		.pipe(gulp.dest('public/css'));
	cb();
}

// function concatCss() {
// 	return gulp.src('public/stylesheets/*.css')
// 		//The method pipe() allow you to chain multiple tasks together 
// 		//I execute the task to minify the files
// 		.pipe(concat('main.css'))
// 		.pipe(gulp.dest('public/stylesheets/'));
// }

// function minifycss(cb) {
// 	// Folder with files to minify
// 	return gulp.src('public/stylesheets/*.css')
// 		//The method pipe() allow you to chain multiple tasks together 
// 		//I execute the task to minify the files
// 		.pipe(cleanCss())
// 		//I define the destination of the minified files with the method dest
// 		.pipe(gulp.dest('public/css'));
// }


function packJs() {
	return gulp.src([
		'frontend/js/*.js',
		'frontend/js/**/*.js'
	])
		// .pipe(stripDebug())
		// .pipe(uglify())
		.pipe(concat('main.js'))
		.pipe(minifyJs())
		.pipe(gulp.dest('public/javascripts'));
};


function runLinter(cb) {
	return src(['**/*.js', '!node_modules/**'])
		.pipe(eslint())
		.pipe(eslint.format())
		.pipe(eslint.failAfterError())
		.on('end', function () {
			cb();
		});
}


function watchFiles(cb) {
	watch(`frontend/html/pages/**/*.+(html|nunjucks|njk)`, njkToHtml);
	watch('sass/**.scss', generateCSS);
	watch(['frontend/js/*.js', 'frontend/js/app/**/*.js'], packJs);
	watch('public/stylesheets/**.css', cleanCss);
	watch(['**/*.js', '!node_modules/**'], parallel(runLinter));
}


function browserSync(cb) {
	sync.init({
		server: {
			baseDir: "./public"
		}
	});
	watch(`frontend/html/pages/**/*.+(html|nunjucks|njk)`, njkToHtml);
	watch('frontend/sass/**.scss', generateCSS);
	watch('public/stylesheets/**.css', cleanCss);
	watch(['frontend/js/*.js', 'frontend/js/app/**/*.js'], packJs);
	watch("./public/**.html").on('change', sync.reload);
}


// exports.default = series(runLinter, parallel(generateCSS, generateHTML));

exports.njkToHtml = njkToHtml;
exports.css = generateCSS;
// exports.minifycss = minifycss;
exports.js = packJs;
exports.lint = runLinter;
exports.watch = watchFiles;
exports.sync = browserSync;
exports.default = series(runLinter, parallel(generateCSS, njkToHtml, packJs));


gulp.task('compile', gulp.series('nunjucks', 'images'));