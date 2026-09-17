<?php
/**
 * Homepage event announcements.
 *
 * @package Jupiter_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uploads = content_url( 'uploads/2026/09' );

// Each event drops off once its 'end' has passed, and the whole section
// disappears when none are left. Event times are Pacific, while the site's
// timezone setting is UTC, so state the zone here.
$events = array(
	array(
		'title'    => __( 'Woodlands Adoption Event', 'mk_framework' ),
		'date'     => __( 'September 19, 2026 &middot; 11:30AM&ndash;2:00PM', 'mk_framework' ),
		'location' => __( 'Woodlands Pet Food &amp; Treats &middot; 296 Bon Air Center, Greenbrae, CA 94904', 'mk_framework' ),
		'note'     => __( 'Find your forever furry friend!', 'mk_framework' ),
		'end'      => new DateTimeImmutable( '2026-09-19 14:00', new DateTimeZone( 'America/Los_Angeles' ) ),
		'photos'   => array(
			array(
				'url' => $uploads . '/img_1961-768x1024.jpg',
				'alt' => __( 'A fluffy red and white husky mix sitting on a sidewalk with her tongue out.', 'mk_framework' ),
			),
			array(
				'url' => $uploads . '/img_2523-768x1024.jpg',
				'alt' => __( 'A brindle hound mix with a white muzzle standing in the grass.', 'mk_framework' ),
			),
		),
	),
	array(
		'title'       => __( 'Shop for a Cause', 'mk_framework' ),
		'description' => __( 'A percentage of all sales during the event will be donated to Milo Foundation, helping support our lifesaving rescue work and the animals in our care.', 'mk_framework' ),
		'date'        => __( 'September 26, 2026 &middot; 12:00&ndash;3:00PM', 'mk_framework' ),
		'location'    => __( 'Belinda Wickwire Jewelry &middot; 528 San Anselmo Ave, San Anselmo, CA 94960', 'mk_framework' ),
		'note'        => __( 'Come meet our dogs and kittens!', 'mk_framework' ),
		'end'         => new DateTimeImmutable( '2026-09-26 15:00', new DateTimeZone( 'America/Los_Angeles' ) ),
		'photos'      => array(
			array(
				'url' => $uploads . '/img_2574-768x1024.jpeg',
				'alt' => __( 'A tan and white shepherd mix with pale blue eyes looking up at the camera.', 'mk_framework' ),
			),
			array(
				'url' => $uploads . '/img_4435-768x1024.jpg',
				'alt' => __( 'A curly black and white poodle mix standing on a tree stump in a eucalyptus grove.', 'mk_framework' ),
			),
		),
	),
);

$now = current_datetime();

$events = array_values(
	array_filter(
		$events,
		function ( $event ) use ( $now ) {
			return $now <= $event['end'];
		}
	)
);

if ( empty( $events ) ) {
	return;
}

?>

<section class="milo-event" aria-labelledby="milo-event-heading">
	<h2 class="milo-event__eyebrow" id="milo-event-heading">
		<?php echo esc_html( _n( 'Upcoming Event', 'Upcoming Events', count( $events ), 'mk_framework' ) ); ?>
	</h2>

	<ul class="milo-event__list<?php echo count( $events ) > 1 ? ' milo-event__list--pair' : ''; ?>">
		<?php foreach ( $events as $event ) : ?>
			<li class="milo-event__item">
				<p class="milo-event__details"><?php echo wp_kses_post( $event['date'] ); ?></p>
				<h3 class="milo-event__title"><?php echo wp_kses_post( $event['title'] ); ?></h3>

				<?php if ( ! empty( $event['description'] ) ) : ?>
					<p class="milo-event__description"><?php echo wp_kses_post( $event['description'] ); ?></p>
				<?php endif; ?>

				<p class="milo-event__location"><?php echo wp_kses_post( $event['location'] ); ?></p>

				<?php if ( ! empty( $event['note'] ) ) : ?>
					<p class="milo-event__note"><?php echo wp_kses_post( $event['note'] ); ?></p>
				<?php endif; ?>

				<ul class="milo-event__photos">
					<?php foreach ( $event['photos'] as $photo ) : ?>
						<li class="milo-event__photo">
							<img
								src="<?php echo esc_url( $photo['url'] ); ?>"
								alt="<?php echo esc_attr( $photo['alt'] ); ?>"
								width="768"
								height="1024"
								loading="lazy"
								decoding="async"
							>
						</li>
					<?php endforeach; ?>
				</ul>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
