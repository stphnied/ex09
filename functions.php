<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

function ajout_google_fonts() {
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700,900', false);
}
add_action('wp_enqueue_scripts', 'ajout_google_fonts');

function extraire_conferences($query) {
    if ($query->is_category('conference')) {
        $query->set('posts_per_page', 6);
        $query->set('orderby', 'title');
        $query->set('order', 'asc');
    }
}
add_action('pre_get_posts', 'extraire_conferences');

function extraire_nouvelles($query) {
    if ($query->is_category('nouvelle')) {
        $query->set('posts_per_page', 4);
        $query->set('orderby', 'title');
        $query->set('order', 'asc');
    }
}
add_action('pre_get_posts', 'extraire_nouvelles');
?>