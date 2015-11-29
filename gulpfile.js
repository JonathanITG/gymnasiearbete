var gulp = require("gulp");
var livereload = require("gulp-livereload");

gulp.task("watch", function() {
    livereload.listen({basepath: "."});

    //watch for php
    gulp.watch("*.php", ['reload']);
});

gulp.task("reload", function() {
    gulp.src("*.php")
    .pipe(livereload());
});