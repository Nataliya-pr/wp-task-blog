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
Template Name: Contact template
*/

get_header(); ?>

<div class="wrap">
	<h2><b>CONTACTS</b></h2>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
			while ( have_posts() ) : the_post();

				the_content();

			

			endwhile; // End of the loop.
			?>

			<!-- <form method="get" class="searchform" action="<?php bloginfo ('url'); ?>/"> -->
			<!-- <form method="post" class="contacform">

				<input type="text" placeholder="Your Name" name="name" class="form-control">
				<input type="email" placeholder="Email" name="email" class="form-control">

				<input class="btn" type="submit" value="SUBMIT">

			</form>
 -->
					
			<pre>
			<?php
			var_dump($_POST);

			$to = 'nataliyavero@gmail.com';
			$subject = 'Новая отправка с сайта';
			$message = 'Name:' . $_POST['my_name'] . "\n";
			$message .= 'Email:' . $_POST['my_email'] . "\n";
			$message .= 'Text:' . $_POST['text'] . "\n";

			wp_mail($to, $subject, $message);
			
			?>
			</pre>

			<form method="post" class="contacform">

				Name: <input type="text" name="my_name"><br>
				Email: <input type="email" name="my_email"><br>
				Text: <textarea name="text"></textarea><br>
				<input type="submit" value="SUBMIT">

			</form>


		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
