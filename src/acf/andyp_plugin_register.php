<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'Responsive Images',
        'icon'      => 'image',
        'color'     => '#34D399',
        'path'      => __FILE__,
    ]);
} );