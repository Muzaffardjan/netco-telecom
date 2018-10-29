const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

/** Style and Script for dashboard */
mix.styles(
    [
        'resources/startmin/css/bootstrap.min.css',
        'resources/startmin/css/metisMenu.min.css',
        'node_modules/font-awesome/css/font-awesome.min.css'
    ],
    'public/dashboard/css/all.css'
);
mix.scripts(
    [
        'resources/startmin/js/jquery.min.js',
        'resources/startmin/js/bootstrap.min.js',
        'resources/startmin/js/metisMenu.min.js'
    ],
    'public/dashboard/js/all.js'
);

/** Data tables */
mix.styles(
    [
        'resources/startmin/css/dataTables/dataTables.bootstrap.css',
        'resources/startmin/css/dataTables/dataTables.responsive.css'
    ],
    'public/dashboard/css/data-tables.css'
);
mix.scripts(
    [
        'resources/startmin/js/dataTables/jquery.dataTables.min.js',
        'resources/startmin/js/dataTables/dataTables.bootstrap.min.js'
    ],
    'public/dashboard/js/data-tables.js'
);

/** Copying startmin js and css file*/
mix.copy('resources/startmin/js/startmin.js', 'public/dashboard/js/main.js');
mix.copy('resources/startmin/css/startmin.css', 'public/dashboard/css/main.css');

/** Copying img folder */
mix.copyDirectory('resources/startmin/img', 'public/dashboard/img');

/** Font awesome font */
mix.copyDirectory('node_modules/font-awesome/fonts', 'public/dashboard/fonts');
