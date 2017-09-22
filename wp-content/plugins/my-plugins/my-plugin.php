<?php
/* 
Plugin name: My Custom Plugin
*/

add_action( 'init', 'add_books', 0 ); // 0  - приоритет (мах)

function add_books() {

    $labels = array(
        'name'                  => _x( 'Books', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Books', 'text_domain' ),
        'name_admin_bar'        => __( 'Books', 'text_domain' ),
        'archives'              => __( 'Book Archives', 'text_domain' ),
        'attributes'            => __( 'Book Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Book:', 'text_domain' ),
        'all_items'             => __( 'All Books', 'text_domain' ),
        'add_new_item'          => __( 'Add New Book', 'text_domain' ),
        'add_new'               => __( 'Add Book', 'text_domain' ),
        'new_item'              => __( 'New Book', 'text_domain' ),
        'edit_item'             => __( 'Edit Book', 'text_domain' ),
        'update_item'           => __( 'Update Book', 'text_domain' ),
        'view_item'             => __( 'View Book', 'text_domain' ),
        'view_items'            => __( 'View Books', 'text_domain' ),
        'search_items'          => __( 'Search Book', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Cover', 'text_domain' ),
        'set_featured_image'    => __( 'Set cover', 'text_domain' ),
        'remove_featured_image' => __( 'Remove cover', 'text_domain' ),
        'use_featured_image'    => __( 'Use as cover', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into book', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Book', 'text_domain' ),
        'items_list'            => __( 'Books list', 'text_domain' ),
        'items_list_navigation' => __( 'Books list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter books list', 'text_domain' ),
    );

    $args = array(
        'label'                 => __( 'Book', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', ),
        'taxonomies'            => array( 'category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-book',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => false,
    );

    register_post_type( 'book', $args );
}


add_action( 'init', 'add_book_genre', 0 );

function add_book_genre() {

    $labels = array(
        'name'                       => _x( 'Genres', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Genres', 'text_domain' ),
        'all_items'                  => __( 'All Genres', 'text_domain' ),
        'parent_item'                => __( 'Parent Genre', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Genre:', 'text_domain' ),
        'new_item_name'              => __( 'New Genre Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Genre', 'text_domain' ),
        'edit_item'                  => __( 'Edit Genre', 'text_domain' ),
        'update_item'                => __( 'Update Genre', 'text_domain' ),
        'view_item'                  => __( 'View Genre', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate Genres with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove Genres', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Genres', 'text_domain' ),
        'search_items'               => __( 'Search Genres', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No genres', 'text_domain' ),
        'items_list'                 => __( 'Genres list', 'text_domain' ),
        'items_list_navigation'      => __( 'Genres list navigation', 'text_domain' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => false,
    );

    register_taxonomy( 'genre', array( 'book' ), $args );
}

?>