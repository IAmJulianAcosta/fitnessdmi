<?php
	$datetime_field = get_field( 'datetime' );
	$day            = utf8_encode( strftime( '%d', $datetime_field ) );
	$day_of_week    = utf8_encode( strftime( '%a', $datetime_field ) );
	$hour           = utf8_encode( strftime( '%H', $datetime_field ) );
	$minute         = utf8_encode( strftime( '%M', $datetime_field ) );

	$sports    = wp_get_post_terms( get_the_ID(), 'event-category' );
	$has_sport = is_array( $sports ) && sizeof( $sports ) > 0;

	$levels    = wp_get_post_terms( get_the_ID(), 'level' );
	$has_level = is_array( $levels ) && sizeof( $levels ) > 0;
?>
<tr class="event">
	<td class="date">
		<time class="event-time">
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
	<td class="destination"><a href="<?php the_field( 'url' ) ?>"><?php the_field(
				'destination' ) ?></a>
	</td>
	<td class="location"><?php the_field( 'location' ) ?></td>
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