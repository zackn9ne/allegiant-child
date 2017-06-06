<?php



add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}



add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {
 
    wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
 
}




// Making sure your child theme has an independent version and can bust caches: https://wordpress.stackexchange.com/a/182023/30783
// Filter get_stylesheet_uri() to return the parent theme's stylesheet
add_filter('stylesheet_uri', 'use_parent_theme_stylesheet');
// Enqueue this theme's scripts and styles (after parent theme)
add_action('wp_enqueue_scripts', 'my_theme_styles', 20);

function use_parent_theme_stylesheet()
{
    // Use the parent theme's stylesheet
    return get_template_directory_uri() . '/style.css';
}

function my_theme_styles()
{
    $themeVersion = wp_get_theme()->get('Version');

    // Enqueue our style.css with our own version
    wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/style.css',
        array(), $themeVersion);
}
