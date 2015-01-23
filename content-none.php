<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package DocBlock
 */

?><section class="no-results not-found">
	<header class="page-header contentnone">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'text-domain' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content"><?php

		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			?><p><?php

				printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'text-domain' ), esc_url( admin_url( 'post-new.php' ) ) );

			?></p><?php

		elseif ( is_search() ) :

			?><p><?php

				_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'text-domain' );

			?></p><?php

			get_search_form();

		else :

			?><p><?php

				_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'text-domain' );

			?></p><?php

			get_search_form();

		endif;

	?></div><!-- .page-content -->
</section><!-- .no-results -->