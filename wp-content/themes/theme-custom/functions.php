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

// nested shortcodes - left and right columns in two_columns
add_shortcode('two_columns', 'to_columns_func');

function to_columns_func($atts, $content){
	ob_start();
	?>

		<div class="two_columns">
			<?=do_shortcode($content);?>
		</div>

	<?php
	return ob_get_clean();
}


add_shortcode('column1', 'column1_func');

function column1_func($atts, $content){
	ob_start();
	?>

		<div class="column_left">
		<?=$content;?>
		</div>

	<?php
	return ob_get_clean();
}

add_shortcode('column2', 'column2_func');

function column2_func($atts, $content){
	ob_start();
	?>

		<div class="column_right">
		<?=$content;?>
		</div>

	<?php
	return ob_get_clean();
}

// можно использовать один обработчик, который добавит один класс - .column - и вызвать:
add_shortcode('column1', 'column_func');
add_shortcode('column2', 'column_func');
function column_func($atts, $content){
	ob_start();
	?>

		<div class="column">
		<?=$content;?>
		</div>

	<?php
	return ob_get_clean();
}

remove_action('the_content', 'wpautop');


// add metabox
add_action('add_meta_boxes_page', 'my_add_metabox');

function my_add_metabox($post) {
    add_meta_box(
        'my-meta-id',
        __( 'My metabox', 'my-text-domain' ),
        'render_my_metabox',
        'page',
        'side',
        'default'
    );
}

function render_my_metabox($post) {
    $value = get_post_meta($post->ID, 'my_phone', true);
    $select = get_post_meta($post->ID, 'my_sel', true);
    $check = get_post_meta($post->ID, 'my_check', true);
    ?>

    <p>
    <input type="text" name="my_phone" id="my_phone" value=<?=$value;?> >
    </p>

    <select name="my_sel">
      <option value="24" <?php if ($select == 24) echo 'selected="selected"';?> >Вариант 24</option>
      <option value="abc" <?php if ($select == 'abc') echo 'selected="selected"';?> >Другой вариант</option>
    </select>

    <p>
      <label for="my_check">
        <input type="checkbox" name="my_check" id="my_check" value="1" <?php if ($check) echo 'checked="checked"';?> >
        Отметка
      </label>
    </p>

    <?php
}


add_action('save_post', 'my_metabox_save');

function my_metabox_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

 	// echo '<pre>';
    // var_dump($_POST);
    // echo '<pre>';
    // wp_die(); // 


    if ( !isset($_POST['my_phone']) ) return $post_id; // есть ли в посте наше поле

    // Sanitize the user input.
    $mydata = sanitize_text_field( $_POST['my_phone'] ); // 'вырезает' из текста опасные части - откуда пришел запрос
    $select = sanitize_text_field( $_POST['my_sel'] );

    $check = isset($_POST['my_check']) ? 1 : 0;

    // Update the meta field.
    update_post_meta( $post_id, 'my_phone', $mydata );
    update_post_meta( $post_id, 'my_sel', $select );


    update_post_meta( $post_id, 'my_check', $check );
}


// add text on page contact
add_shortcode('contact_text', 'contact_text_func');
function contact_text_func($atts, $content){
	ob_start();
	?>

		<p>$content</p>

	<?php
	return ob_get_clean();
}





// add metabox for portfolio
add_action('add_meta_boxes_portfolio', 'portfolio_add_metabox');

function portfolio_add_metabox($post) {
    add_meta_box(
        'portfolio-meta-id',
        __( 'Portfolio metabox', 'my-text-domain' ),
        'render_portfolio_metabox',
        'portfolio',
        'side',
        'default'
    );
}

function render_portfolio_metabox($post) {
    $date = get_post_meta($post->ID, 'portfolio_date', true);
    $link = get_post_meta($post->ID, 'portfolio_link', true);
    ?>

	    <p>Portfolio date:<br>
	    <input type="text" name="portfolio_date" id="portfolio_date" value=<?=$date;?> >
	    </p>
	    <p>Portfolio link:<br>
	    <input type="text" name="portfolio_link" id="portfolio_link" value=<?=$link;?> >
	    </p>

   <?php
}


add_action('save_post', 'portfolio_metabox_save');

function portfolio_metabox_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

 	// echo '<pre>';
    // var_dump($_POST);
    // echo '<pre>';
    // wp_die(); // 


    if ( !isset($_POST['portfolio_date']) ) return $post_id; // есть ли в посте наше поле

    // Sanitize the user input.
    $pfdate = sanitize_text_field( $_POST['portfolio_date'] ); // 'вырезает' из текста опасные части - откуда пришел запрос
    $pflink = sanitize_text_field( $_POST['portfolio_link'] );

    // Update the meta field.
    update_post_meta( $post_id, 'portfolio_date', $pfdate );
    update_post_meta( $post_id, 'portfolio_link', $pflink );

}

?>
