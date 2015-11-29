var gulp = require("gulp");
var livereload = require("gulp-livereload");
var gulpsass = require("gulp-sass");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var csswring = require("csswring");

var processors = [
    autoprefixer({browsers: ["last 2 versions"]}),
    csswring({ preserveHacks: true, removeAllComments: true})
];

gulp.task("watch", function() {
    livereload.listen({basepath: "."});

    //watch for php
    gulp.watch("dist/*.php", ['php']);
    gulp.watch("src/sass/*.scss", ['scss']);
});

gulp.task("php", function() {
    gulp.src("dist/*.php")
    .pipe(livereload());
});

gulp.task("scss", function() {
    gulp.src("./src/sass/*.scss")
        .pipe(gulpsass({sync: false}))
        .pipe(postcss(processors))
        .pipe(gulp.dest("dist/assets/css"))
        .pipe(livereload());
});