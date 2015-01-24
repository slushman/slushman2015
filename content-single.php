<?php
/**
 * @package Slushman 2015
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header contentsingle"><?php

		the_title( '<h1 class="entry-title">', '</h1>' );

		?><div class="entry-meta"><?php

			slushman_2015_posted_on();

		?></div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content"><?php

		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'slushman2015' ),
			'after'  => '</div>',
		) );

	?></div><!-- .entry-content -->

	<footer class="entry-footer"><?php

		slushman_2015_entry_footer();

	?></footer><!-- .entry-footer -->
</article><!-- #post-## -->