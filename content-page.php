<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Slushman 2015
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header contentpage"><?php

		the_title( '<h1 class="entry-title">', '</h1>' );

	?></header><!-- .entry-header -->

	<div class="entry-content"><?php

		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'slushman2015' ),
			'after'  => '</div>',
		) );

	?></div><!-- .entry-content -->

	<footer class="entry-footer"><?php

		edit_post_link( __( 'Edit', 'slushman2015' ), '<span class="edit-link">', '</span>' );

	?></footer><!-- .entry-footer -->
</article><!-- #post-## -->