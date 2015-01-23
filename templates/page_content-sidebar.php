<?php
/**
 * Template Name: Content Sidebar
 * 
 * Description: Page template with sidebar on the right-side
 *
 * @package DocBlock
 */

get_header(); ?>

	<div id="primary" class="content-area content-sidebar">
		<main id="main" class="site-main" role="main"><?php

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'page' );

					// If comments are open or have more than one comment, load comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;

			endwhile; // loop

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_sidebar();
get_footer(); ?>