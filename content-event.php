<?php
	$datetime_field = get_field( 'datetime' );
	$day            = utf8_encode( strftime( '%d', $datetime_field ) );
	$day_of_week    = utf8_encode( strftime( '%a', $datetime_field ) );
	$hour           = utf8_encode( strftime( '%H', $datetime_field ) );
	$minute         = utf8_encode( strftime( '%M', $datetime_field ) );
	
	$datetime_string = date( 'Y-m-d G:i', $datetime_field );
	
	$sports    = wp_get_post_terms( get_the_ID(), 'event-category' );
	$has_sport = is_array( $sports ) && sizeof( $sports ) > 0;

	$levels    = wp_get_post_terms( get_the_ID(), 'level' );
	$has_level = is_array( $levels ) && sizeof( $levels ) > 0;

	$starting_points    = wp_get_post_terms( get_the_ID(), 'starting-point' );
	$has_starting_point = is_array( $starting_points ) && sizeof( $starting_points ) > 0;
?>
<tr class="event" itemprop="event" itemscope itemtype="http://schema.org/Event">
	<td class="date">
		<meta itemprop="startDate" content="<?php echo $datetime_string ?>">
		<time class="event-time" datetime="<?php echo $datetime_string ?>">
			<span class="day-name"><?php echo $day_of_week ?></span>
			<span class="day"><?php echo $day ?></span>
		</time>
	</td>
	<td class="sport">
		<?php
			if ( $has_sport ) {
				$sport = $sports [0];
				?><span class="sport icon <?php echo $sport->slug ?>"></span><?php
			}
		?>
	</td>
	<td class="destination"><a href="<?php the_field( 'url' ) ?>"><span itemprop="name"><?php the_field( 'destination' )
				?></span></a>
	</td>
	<td class="location" itemprop="location" itemscope itemtype="http://schema.org/Place">
		<?php
			if ( $has_starting_point ) {
				$starting_point = $starting_points [0];
				$term_id = "{$starting_point->taxonomy}_{$starting_point->term_id}"
				?>
				<span itemprop="name"><?php echo $starting_point->name ?></span>
				<meta itemprop="address" content="<?php the_field( 'direccion', $term_id ) ?>">
				<?php
			}
		?>
	</td>
	<td class="time">
		<time><?php echo sprintf( '%s:%s', $hour, $minute ) ?></time>
	</td>
	<td class="level">
		<?php
			if ( $has_level ) {
				$level = $levels [0];
				?><span class="<?php echo $level->slug ?> level icon"></span><?php
			}
		?>
	</td>
</tr>