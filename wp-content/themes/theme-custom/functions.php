<?php
function my_theme_enqueue_styles() {

    $parent_style = 'twentyseventeen-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_title($title){
	$title = $title . ' - ' . date('d.m.Y');

	return $title;
} 

add_filter('the_title', 'my_title');

function main_title($bloginfo){
	$bloginfo = get_bloginfo( 'name' );
	$bloginfo = $bloginfo . ' - ' . 'tel (096) 99-99-999';

	return $bloginfo;
} 

add_filter(bloginfo, 'main_title');


add_filter('the_content', 'add_text_to_content');
function add_text_to_content($content){
	$out = $content . "<p>При копировании статьи, ставьте обратную ссылку, пожалуйста!</p>";
	return $out;
}
?>