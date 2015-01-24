<?php
/**
 * @package Slushman 2015
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header justcontent"><?php

		the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );

		if ( 'post' == get_post_type() ) :

			?><div class="entry-meta"><?php

				slushman_2015_posted_on();

			?></div><!-- .entry-meta --><?php

		endif;

	?></header><!-- .entry-header -->

	<div class="entry-content"><?php

			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'slushman2015' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'slushman2015' ),
				'after'  => '</div>',
			) );

	?></div><!-- .entry-content -->

	<footer class="entry-footer"><?php

		slushman_2015_entry_footer();

	?></footer><!-- .entry-footer -->
</article><!-- #post-## -->