<?php

add_theme_support('post-thumbnails', array('post'));

add_image_size( 'featured-img-size', 700, 700, false ); // 700px X 700px

function theme_styles() {

    wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'master_css', get_template_directory_uri() . '/css/master.css' );
    wp_enqueue_style('jobs_css', 'http://localhost/talents/css/jobs.css');
    wp_enqueue_style('fa_css', "http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css");
    wp_enqueue_style( 'fonts_css', get_template_directory_uri() . '/fonts/fonts.css' );
    wp_enqueue_style( 'wp_main_css', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'theme_styles');


function theme_scripts() {

    wp_enqueue_script('jquery_js', get_template_directory_uri() . '/js/jquery-1.11.2.min.js', '', '', true );

    wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', '', '', true );

    wp_enqueue_script('custom_js', get_template_directory_uri() . '/js/custom.js', '', '', true );



}
add_action( 'wp_enqueue_scripts', 'theme_scripts');

// this is to end a post excerpt with a sentence
function end_with_sentence_on_save($data, $postarr) {
    if ( ! empty( $data['post_content'] ) && $data['post_status'] != 'inherit' && $data['post_status'] != 'trash' ) {
        $text = strip_shortcodes( $data['post_content'] );
        $text = apply_filters('the_content', $text );
        $text = str_replace(']]>', ']]&gt;', $text );
        $excerpt_length = apply_filters('excerpt_length', 55);
        $data['post_excerpt'] = wp_trim_words($text, $excerpt_length, '');
    } else {
        return $data;
    }
    $allowed_end = array('.', '!', '?', '...');
    $exc = explode(' ', $data['post_excerpt']);
    $found = false;
    $last = '';
    while ( ! $found && ! empty($exc) ) { 
        $last = array_pop($exc);
        $end = strrev( $last );
        $found = in_array( $end{0}, $allowed_end );
    }
    if (! empty($exc)) $data['post_excerpt'] = rtrim(implode(' ', $exc) . ' ' .$last);
    return $data; 
}
add_filter('wp_insert_post_data', 'end_with_sentence_on_save', 20, 2);
