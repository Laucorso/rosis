const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.postCss('resources/css/home.css', 'public/css');//.purgeCss( /*{ safelist: { deep: [/flex/] }, }*/ );
mix.combine([
    'resources/js/jquery.js',
    /*'resources/js/bootstrap.js'*/
    'resources/js/bootstrap.bundle.js',
    'resources/js/wow.js',
    'resources/js/home.js',
],'public/js/home.js');

mix.postCss('resources/css/app.css', 'public/css');
mix.combine([
    'resources/js/jquery.js',
    'resources/js/bootstrap.bundle.js',
    'resources/js/wow.js',
    /*'resources/js/isotope.pkgd.js',*/
    'resources/js/jquery.mb.YTPlayer.js',
    'resources/js/jquery.flexslider.js',
    'resources/js/owl.carousel.js',
    'resources/js/main.js',
],'public/js/app.js');

mix.postCss('resources/css/admin.css', 'public/css');
mix.combine([
    'resources/js/jquery.js',
    /*'resources/js/bootstrap.js',*/
    'resources/js/bootstrap.bundle.js',
    'resources/js/bootstrap-multiselect.js',
    /*'resources/js/isotope.pkgd.js',
    'resources/js/imagesloaded.pkgd.js',
    'resources/js/jquery.flexslider.js',*/
    'resources/js/jquery.easing.js',
    'resources/js/jquery.dataTables.js',
    'resources/js/dataTables.bootstrap4.js',
    'resources/js/suneditor.min.js',
    'node_modules/tinymce/tinymce.js',
    'resources/js/xmm.js',
    'resources/js/admin.js',
],'public/js/admin.js');
