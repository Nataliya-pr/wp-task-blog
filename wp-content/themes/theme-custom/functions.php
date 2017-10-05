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


add_action( 'admin_enqueue_scripts', 'np_admin_scripts2' );
function np_admin_scripts2(){
    wp_enqueue_script('iris');
    wp_enqueue_style('iris');
    wp_enqueue_script('np-admin2', get_stylesheet_directory_uri() . '/js/admin.js', array('jquery', 'iris'), '', true );
}


// script datepicker
// function add_my_scripts() {
//     wp_enqueue_script(
//         'jquery-ui-datepicker',
//         get_stylesheet_directory_uri() . '/js/jquery-ui.js',
//         array('jquery', 'main'),
//         '1.2',
//         true
//     );
// }
// add_action( 'admin_enqueue_scripts', 'add_my_scripts' );

// styles datepicker
// function add_my_styles() {
//     wp_enqueue_style(
//         'datepicker-css',
//         get_stylesheet_directory_uri() . '/js/jquery-ui.theme.css',
//         array(),
//         '1.2'
//     );
// }
// add_action( 'wp_enqueue_scripts', 'add_my_styles' );



// function enqueue_frontend_scripts_and_style() {
//  // datepicker
//  wp_enqueue_script('jquery-ui-datepicker');
//  wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
//  }
// add_action('wp_enqueue_scripts', 'enqueue_frontend_scripts_and_style');


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

// Widget
class My_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array(
            'classname' => 'my_widget',
            'description' => 'My Widget description for WP Admin',
        );

        parent::__construct( 'my_widget', 'My Widget', $widget_ops );
    }

    // public function widget( $args, $instance ) {
    //     echo 'Hello!';
    // }
	public function widget( $args, $instance ) {
	    echo $args['before_widget'];

	    if ( ! empty( $instance['title'] ) ) {
	    	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
	    }

	   // echo esc_html__( 'Hello!', 'text_domain' );
	    if ( $instance['echo_date'] ) {
	    	echo date('d.m.Y');
	    }
	    echo $args['after_widget'];
	}


    public function form( $instance ) {
	    $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'My Widget', 'text_domain' );
	    $echo_date = ! empty( $instance['echo_date'] ) ? $instance['echo_date'] : '';

	    ?>

	    <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
	        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	    </p>

	<p>
       <label for="<?php echo esc_attr( $this->get_field_id( 'echo_date' ) ); ?>"><?php esc_attr_e( 'Echo date:', 'text_domain' ); ?></label>
       <input class="" id="<?php echo esc_attr( $this->get_field_id( 'echo_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'echo_date' ) ); ?>" type="checkbox" value="1" <?php if ($echo_date) echo 'checked="checked"'; ?>>
   </p>

	    <?php
	}

	public function update( $new_instance, $old_instance ) {
	    $instance = array();
	    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	    $instance['echo_date'] = ( ! empty( $new_instance['echo_date'] ) ) ? strip_tags( $new_instance['echo_date'] ) : '';

	    return $instance;
	}

}

add_action( 'widgets_init', 'np_register_my_widget');

function np_register_my_widget() {
    register_widget( 'My_Widget' );
}

// columns
add_filter( 'manage_posts_columns' , 'np_posts_columns' );

function np_posts_columns( $columns ) {
    $columns['my_column'] = __( 'My Column', 'np-portfolio' );
    // unset($columns['author']); // удаление колонки

    return $columns;
}

add_action( 'manage_posts_custom_column' , 'np_posts_columns_content', 10, 2 );

function np_posts_columns_content( $column, $post_id ) {
    if ($column == 'my_column') {
        echo $post_id;
    }
}


// add menu page
add_action( 'admin_menu', 'np_menu_pages' );

function np_menu_pages() {
    add_menu_page(
        __('My Settings Page', 'np-portfolio'), // $page_title
        __('My Settings', 'np-portfolio'), // $menu_title
        'manage_options', // $capability, Admin user
        'np_my_settings', // $menu_slug
        'np_my_settings_render', // $function
        'dashicons-welcome-learn-more', // $icon_url
        65 // $position
    );

     add_submenu_page(
        'np_my_settings', // $parent_slug
        __('My Settings Subpage', 'np-portfolio'), // $page_title
        __('More Settings', 'np-portfolio'), // $menu_title
        'manage_options', // $capability, Admin user
        'np_my_more_settings', // $menu_slug
        'np_my_more_settings_render' // $function
    );

}

function np_my_settings_render() {
    ?>

    <!-- Стандартная разметка Wordpress -->
    <div class="wrap">

        <!-- Заголовок страницы настроек  -->
        <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
        <!-- Показывать сообщения админ-панели  -->
        <?php settings_errors(); ?>

        <form method="post" action="options.php">
            <?php
            // Добавить служебные поля Wordpress
            settings_fields('np_my_settings');

            // Отобразить зарегистрированные поля
            do_settings_sections('np_my_settings');

            // Добавить кнопку сохранения
            submit_button();
            ?>
        </form>
    </div>

    <?php
}

function np_my_more_settings_render() {}

add_action( 'admin_init', 'np_register_settings' );

function np_register_settings() {
    add_settings_section(
        'np_setting_section', // $id, поля настроек привязываются к этому $id
        __('Example settings section in reading', 'np-portfolio'), // $title - заголовок секции
        'np_setting_section_render', // $function - функция, которая будет выводить секцию
        'np_my_settings' // $menu_slug страницы настроек
    );

    add_settings_field(
        'np_my_setting', // $name - имя поля в базе данных
        __('Setting', 'np-portfolio'), // $title - заголовок секции
        'np_setting_field_function', // $function - функция, которая будет выводить поле
        'np_my_settings', // $menu_slug страницы настроек
        'np_setting_section', // $id секции
        ['name' => 'np_my_settings']
    );
    add_settings_field(
        'np_my_setting2', // $name - имя поля в базе данных
        __('Setting 2', 'np-portfolio'), // $title - заголовок секции
        'np_setting_field_function', // $function - функция, которая будет выводить поле
        'np_my_settings', // $menu_slug страницы настроек
        'np_setting_section', // $id секции
        ['name' => 'np_my_settings2']
    );

    // choose ncurses_color_set(
    add_settings_section(
        'np_color_section', // $id, поля настроек привязываются к этому $id
        __('Choose color', 'np-portfolio'), // $title - заголовок секции
        '', // $function - функция, которая будет выводить секцию
        'np_my_settings' // $menu_slug страницы настроек
    );
    add_settings_field(
        'np_menu_color', // $name - имя поля в базе данных
        __('Menu color', 'np-portfolio'), // $title - заголовок секции
        'np_setting_field_function', // $function - функция, которая будет выводить поле
        'np_my_settings', // $menu_slug страницы настроек
        'np_color_section', // $id секции
        [
        'name' => 'np_menu_color',
        'class' => 'np_color_select'
        ]
    );

    // choose quantity
    add_settings_section(
        'np_quantity_section', // $id, поля настроек привязываются к этому $id
        __('Choose quantity', 'np-portfolio'), // $title - заголовок секции
        '', // $function - функция, которая будет выводить секцию
        'np_my_settings' // $menu_slug страницы настроек
    );
    add_settings_field(
        'np_menu_quantity', // $name - имя поля в базе данных
        __('Menu quantity', 'np-portfolio'), // $title - заголовок секции
        'np_setting_field_function', // $function - функция, которая будет выводить поле
        'np_my_settings', // $menu_slug страницы настроек
        'np_quantity_section', // $id секции
        [
        'name' => 'np_menu_quantity',
        'class' => 'np_quantity_select',
        'type' => 'select'
        ]
    );

    // checkbox
    add_settings_section(
        'np_checkbox_section', // $id, поля настроек привязываются к этому $id
        __('Choose', 'np-portfolio'), // $title - заголовок секции
        '', // $function - функция, которая будет выводить секцию
        'np_my_settings' // $menu_slug страницы настроек
    );
    add_settings_field(
        'np_checkbox', // $name - имя поля в базе данных
        __('Yes/No', 'np-portfolio'), // $title - заголовок секции
        'np_setting_field_function', // $function - функция, которая будет выводить поле
        'np_my_settings', // $menu_slug страницы настроек
        'np_checkbox_section', // $id секции
        [
        'name' => 'np_checkbox',
        'class' => 'np_checkbox_select',
        'type' => 'checkbox'
        ]
    );

    register_setting(
        'np_my_settings', // $menu_slug страницы настроек
        'np_my_setting' // $name - имя поля в базе данных
    );
    register_setting(
        'np_my_settings', // $menu_slug страницы настроек
        'np_my_setting2' // $name - имя поля в базе данных
    );
    register_setting(
        'np_my_settings', // $menu_slug страницы настроек
        'np_menu_color' // $name - имя поля в базе данных
    );
    register_setting(
        'np_my_settings', // $menu_slug страницы настроек
        'np_menu_quantity' // $name - имя поля в базе данных
    );
    register_setting(
        'np_my_settings', // $menu_slug страницы настроек
        'np_checkbox' // $name - имя поля в базе данных
    );
}

function np_setting_section_render() {
    echo '<p class="description">Intro text for our settings section</p>';
}

function np_setting_field_function($args) {
    $name = $args['name'];
    $type = $args['type'];
    $value = get_option($name);
    $class = isset($args['class']) ? $args['class'] : '';

    if ($type == 'checkbox') {
        echo '<input type="checkbox" class="' . $class . '" id="' . $name . '" name="' . $name . '" value="1" ' . checked( 1, get_option( $name ), false ) . ' />';
    } else if ($type == 'select') {
         ?>
           <select class="' . $class . '" id="' . $name . '" name="' . $name . '">
              <option value="2000" <?php if ('selected' == '2000') echo 'selected="selected"';?> >2000</option>
              <option value="2001" <?php if ('selected' == '2001') echo 'selected="selected"';?> >2001</option>
              <option value="2002" <?php if ('selected' == '2002') echo 'selected="selected"';?> >2002</option>
              <option value="2003" <?php if ('selected' == '2003') echo 'selected="selected"';?> >2003</option>
              <option value="2004" <?php if ('selected' == '2004') echo 'selected="selected"';?> >2004</option>
              <option value="2005" <?php if ('selected' == '2005') echo 'selected="selected"';?> >2005</option>
            </select>
            <?php
            
    } else echo '<input type="text" class="' . $class . '" id="' . $name . '" name="' . $name . '" value="' . $value . '">';
   
}

add_action('wp_head', 'np_menu_color');
function np_menu_color(){
    ?>
   <style>
     .navigation-top a {
       color: <?=get_option('np_menu_color');?>;
     }
   </style>
     <?php
}

?>
