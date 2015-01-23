<?php
/**
 * Template Name: Full-width, no sidebar
 * 
 * Description: A full-width template with no sidebar
 *
 * @package DocBlock
 */

get_header(); ?>

		<div class="wrap">
			<div id="content" class="full-width"><?php

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'page' );
				
				// If comments are open or have more than one comment, load comment template
				if ( comments_open() || '0' != get_comments_number() ) {
				
					comments_template();
				
				} // comments check

			endwhile; // loop
				
			?></div><!-- .full-width --><?php
				
get_footer(); ?>