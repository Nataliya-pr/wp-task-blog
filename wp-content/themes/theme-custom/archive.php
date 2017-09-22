<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
/*
Template Name: Portfolio template
*/

get_header(); ?>
sdsds
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
