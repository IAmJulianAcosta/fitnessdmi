<?php get_header() ?>
<header>
	<h1><span class="page-title">Fitness DMI</span><span class="separator"> | </span>
		<time>Septiembre 2015</time>
	</h1>
</header>
<main>
	<table id="schedule">
		<thead>
		<tr>
			<th class="date"><span class="icon date header-icon"></span></th>
			<th class="sport"></th>
			<th class="destination"><span class="icon destination header-icon"></span></th>
			<th class="location"><span class="icon location header-icon"></span></th>
			<th class="time"><span class="icon time header-icon"></span></th>
			<th class="level"><span class="icon level-header"></span></th>
		</tr>
		</thead>
		<tbody>
		<?php
			$first_of_month = strtotime( date( '01-m-Y' ) );
			$last_of_month  = strtotime( date( 't-m-Y 23:59:59' ) );
			$events_args    = array (
				'posts_per_page' => 30,
				'post_type'      => array ( 'event' ),
				'meta_query'     => array (
					array (
						'key'     => 'datetime',
						'compare' => '>=',
						'value'   => $first_of_month
					),
					array (
						'key'     => 'datetime',
						'compare' => '<=',
						'value'   => $last_of_month
					)
				),
				'orderby'        => 'meta_value_num',
				'meta_key'       => 'datetime',
				'order'          => 'ASC'
			);
			$events_query   = new WP_Query( $events_args );
			if ( $events_query->have_posts() ) {
				while ( $events_query->have_posts() ) {
					$events_query->the_post();

					$datetime_field = get_field( 'datetime' );
					$day            = utf8_encode( strftime( '%d', $datetime_field ) );
					$day_of_week    = utf8_encode( strftime( '%a', $datetime_field ) );
					$hour           = utf8_encode( strftime( '%H', $datetime_field ) );
					$minute         = utf8_encode( strftime( '%M', $datetime_field ) );

					$sports = wp_get_post_terms( get_the_ID(), 'event-category' );
					$sport  = $sports [0];

					$levels = wp_get_post_terms( get_the_ID(), 'level' );
					$level  = $levels [0];
					?>
					<tr class="event">
						<td class="date">
							<time class="event-time">
								<span class="day-name"><?php echo $day_of_week ?></span>
								<span class="day"><?php echo $day ?></span>
							</time>
						</td>
						<td class="sport">
							<span class="sport icon <?php echo $sport->slug ?>"></span>
						</td>
						<td class="destination"><a href="<?php the_field( 'url' ) ?>"><?php the_field(
									'destination' ) ?></a>
						</td>
						<td class="location"><?php the_field( 'location' ) ?></td>
						<td class="time">
							<time><?php echo sprintf( '%s:%s', $hour, $minute ) ?></time>
						</td>
						<td class="level">
							<span class="<?php echo $level->slug ?> level icon"></span>
						</td>
					</tr>
					<?php
				}
			}
		?>

		</tbody>
	</table>
	<aside class="legend">
		<ul class="sports-legend">
			<?php
				$categories = get_terms(
					'event-category', array (
					'hide_empty' => false
				) );
				foreach ( $categories as $category ) {
					?>
					<li class="sports-legend-item">
						<span class="<?php echo $category->slug ?> sport icon"></span><span
							class="title"><?php echo $category->name ?></span>
					</li>
					<?php
				}
			?>

		</ul>
		<ul class="general-legend">
			<li class="general-legend-item">
				<span class="icon date header-icon"></span><span class="title">Fecha</span>
			</li>
			<li class="general-legend-item">
				<span class="icon destination header-icon"></span><span class="title">Meta / Objetivo</span>
			</li>
			<li class="general-legend-item">
				<span class="icon location header-icon"></span><span class="title">Punto de encuentro</span>
			</li>
			<li class="general-legend-item">
				<span class="icon time header-icon"></span><span class="title">Hora de inicio</span>
			</li>
			<li class="general-legend-item">
				<span class="icon level-header"></span><span class="title">Nivel / Dificultad</span>
				<ul class="level-legend">
					<?php
						$levels = get_terms(
							'level', array (
								       'hide_empty' => false
							       ) );
						foreach ( $levels as $level ) {
							?>
							<li class="level-legend-item">
								<span class="<?php echo $level->slug ?> icon level"></span><span
									class="title"><?php echo $level->name ?></span>
							</li>
							<?php
						}
					?>
				</ul>
			</li>
		</ul>
		<h2>Requisitos</h2>
		<ul class="requirements">
			<li class="requirement">Hidratación</li>
			<li class="requirement">Bloqueador Solar</li>
			<li class="requirement">Casco - Guantes (MTB)</li>
			<li class="requirement">Técnico-mecánica al día (MTB)</li>
			<li class="requirement">Luces (delantera y trasera - MTB)</li>
			<li class="requirement">Puntualidad</li>
		</ul>
		<ul class="social-networks">
			<li class="social-network"><a href="https://www.facebook.com/groups/DMIpedalea/"
			                              class="social-network-link"><span class="icon facebook"></span>/fitnessDMI</a>
			</li>
		</ul>
	</aside>
</main>
<?php get_footer() ?>
