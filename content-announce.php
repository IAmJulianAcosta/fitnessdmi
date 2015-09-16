<div class="announce">
	<?php
		$announce_args = array (
			'pagename' => 'announce',
		);

		$announce_query = new WP_Query( $announce_args );

		if ( $announce_query->have_posts() ) {
			while ( $announce_query->have_posts() ) {
				$announce_query->the_post();
				the_content();
			}
			wp_reset_postdata();
		}
	?>
</div>

