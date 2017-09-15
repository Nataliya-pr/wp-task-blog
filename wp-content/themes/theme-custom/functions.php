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

// add_filter('the_title', 'my_title');

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

add_shortcode( 'my_shortcode', 'do_my_shortcode' );

function do_my_shortcode($atts, $content) {
    ob_start();

    if ( isset( $atts['size'] ) ) {
        echo '<span style="font-size: ' . $atts['size'] . '">';
    }

    echo 'Мой шорткод: ' . $content;

    if ( isset( $atts['size'] ) ) {
        echo '</span>';
    }

    return ob_get_clean();
}

// color
add_shortcode( 'shortcode_color', 'do_shortcode_color' );

function do_shortcode_color($atts, $content) {
    ob_start();

    if ( isset( $atts['color'] ) ) {
        echo '<span style="color: ' . $atts['color'] . '">';
    }

    echo $content;

    if ( isset( $atts['color'] ) ) {
        echo '</span>';
    }

    return ob_get_clean();
}

// author
add_shortcode( 'shortcode_author', 'do_shortcode_author' );

function do_shortcode_author($atts, $content) {
    ob_start();

   echo '<a href="'.get_the_author_link().'">'.get_the_author().'</a>'  ;

    return ob_get_clean();
}

// columns
add_shortcode( 'shortcode_column', 'do_shortcode_column' );

function do_shortcode_column($atts, $content) {
    ob_start();
   
    echo '<div class="col-half">' . $content . '</div>';
    
    return ob_get_clean();
}

// posts per page
add_action( 'pre_get_posts', 'post_number', 1 );
function post_number( $query ) {
   
    if ( is_home() ) {
        $query->set( 'posts_per_page', 4 );
        return;
    }

}

?>

<!-- 
$query = new WP_Query( array( 'posts_per_page' => 3 ) ); -->