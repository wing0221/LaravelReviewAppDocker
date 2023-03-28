const mix = require('laravel-mix');
 
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
 
mix
  .styles([
    'resources/css/animate.min.css',
    'resources/css/bootstrap-cerulean.min.css',
    'resources/css/bootstrap-cyborg.min.css',
    'resources/css/bootstrap-darkly.min.css',
    'resources/css/bootstrap-lumen.min.css',
    'resources/css/bootstrap-simplex.min.css',
    'resources/css/bootstrap-slate.min.css',
    'resources/css/bootstrap-spacelab.min.css',
    'resources/css/bootstrap-united.min.css',
    'resources/css/charisma-app.css',
    'resources/css/elfinder.min.css',
    'resources/css/elfinder.theme.css',
    'resources/css/jquery-ui-1.8.21.custom.css',
    'resources/css/jquery.iphone.toggle.css',
    'resources/css/jquery.noty.css',
    'resources/css/noty_theme_default.css',
    'resources/css/uploadify.css',
    'resources/bower_components/fullcalendar/dist/fullcalendar.css',
    'resources/bower_components/fullcalendar/dist/fullcalendar.print.css',
    'resources/bower_components/chosen/chosen.min.css',
    'resources/bower_components/colorbox/example3/colorbox.css',
    'resources/bower_components/responsive-tables/responsive-tables.css',
    'resources/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css',
  ], 'public/css/app.css')
  .scripts([
    'resources/bower_components/jquery/jquery.min.js',
    'resources/js/charisma.js',
    'resources/js/init-chart.js',
    'resources/js/jquery.autogrow-textarea.js',
    'resources/js/jquery.cookie.js',
    'resources/js/jquery.dataTables.min.js',
    'resources/js/jquery.history.js',
    'resources/js/jquery.iphone.toggle.js',
    'resources/js/jquery.noty.js',
    'resources/js/jquery.raty.min.js',
    'resources/js/jquery.uploadify-3.1.min.js',
    'resources/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'resources/bower_components/moment/min/moment.min.js',
    'resources/bower_components/fullcalendar/dist/fullcalendar.min.js',
    'resources/bower_components/chosen/chosen.jquery.min.js',
    'resources/bower_components/colorbox/jquery.colorbox-min.js',
    'resources/bower_components/responsive-tables/responsive-tables.js',
    'resources/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js',
    'resources/js/jquery.dataTables.min.js'
  ], 'public/js/app.js');