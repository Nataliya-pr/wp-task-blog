<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

Hierarhy test - archive.php

<div class="wrap">
	<h2>PORTFOLIO</h2>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
				

				$args = [
					'post_type' => 'portfolio',
					'posts_per_page' => '3',

				];

				$query = new WP_Query( $args);
				while ( $query->have_posts() ) {
						$query->the_post();
						// echo get_the_ID();
				
				echo '<h1>' . get_the_title() . '</h1>';
				
				
			}


			
				?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
