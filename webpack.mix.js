const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    resolve: {
        extensions: ['.js'],
        alias: {
            'load-image': 'blueimp-load-image/js/load-image.js',
            'load-image-scale': 'blueimp-load-image/js/load-image-scale.js',
            'load-image-meta': 'blueimp-load-image/js/load-image-meta.js',
            'load-image-exif': 'blueimp-load-image/js/load-image-exif.js',
            'canvas-to-blob': 'blueimp-canvas-to-blob/js/canvas-to-blob.js',
            'jquery-ui/ui/widget': 'blueimp-file-upload/js/vendor/jquery.ui.widget.js'
        }
    }
});

mix.js('resources/js/app.js', 'public/js')/*
    .scripts([
        'resources/js/vendor/jquery.ui.widget.js',
        'resources/js/vendor/blueimp/jquery.fileupload.js',
        'resources/js/vendor/blueimp/jquery.iframe-transport.js',
    ], 'public/js/file-upload.js')*/
    .styles([
        'resources/css/vendor/blueimp/jquery.fileupload.css',
        'resources/css/vendor/blueimp/jquery.fileupload-ui.css',
        'resources/css/vendor/blueimp/style.css',
    ], 'public/css/vendor.css')
   .sass('resources/sass/app.scss', 'public/css');
