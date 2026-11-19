<?php
/**
 * Homepage event announcements.
 *
 * Content is editable under Appearance → Customize → Homepage Events.
 * Each event drops off once its end datetime has passed (Pacific), and the
 * whole section disappears when none are left.
 *
 * @package Jupiter_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uploads = content_url( 'uploads/2026/09' );
$pacific = new DateTimeZone( 'America/Los_Angeles' );

$slot_defaults = array(
	1 => array(
		'title'         => __( 'Woodlands Adoption Event', 'mk_framework' ),
		'description'   => '',
		'date'          => __( 'September 19, 2026 &middot; 11:30AM&ndash;2:00PM', 'mk_framework' ),
		'location'      => __( 'Woodlands Pet Food &amp; Treats &middot; 296 Bon Air Center, Greenbrae, CA 94904', 'mk_framework' ),
		'note'          => __( 'Find your forever furry friend!', 'mk_framework' ),
		'end'           => '2026-09-19 14:00',
		'photo_1_url'   => $uploads . '/img_1961-768x1024.jpg',
		'photo_1_alt'   => __( 'A fluffy red and white husky mix sitting on a sidewalk with her tongue out.', 'mk_framework' ),
		'photo_2_url'   => $uploads . '/img_2523-768x1024.jpg',
		'photo_2_alt'   => __( 'A brindle hound mix with a white muzzle standing in the grass.', 'mk_framework' ),
	),
	2 => array(
		'title'         => __( 'Shop for a Cause', 'mk_framework' ),
		'description'   => __( 'A percentage of all sales during the event will be donated to Milo Foundation, helping support our lifesaving rescue work and the animals in our care.', 'mk_framework' ),
		'date'          => __( 'September 26, 2026 &middot; 12:00&ndash;3:00PM', 'mk_framework' ),
		'location'      => __( 'Belinda Wickwire Jewelry &middot; 528 San Anselmo Ave, San Anselmo, CA 94960', 'mk_framework' ),
		'note'          => __( 'Come meet our dogs and kittens!', 'mk_framework' ),
		'end'           => '2026-09-26 15:00',
		'photo_1_url'   => $uploads . '/img_2574-768x1024.jpeg',
		'photo_1_alt'   => __( 'A tan and white shepherd mix with pale blue eyes looking up at the camera.', 'mk_framework' ),
		'photo_2_url'   => $uploads . '/img_4435-768x1024.jpg',
		'photo_2_alt'   => __( 'A curly black and white poodle mix standing on a tree stump in a eucalyptus grove.', 'mk_framework' ),
	),
	3 => array(
		'title'         => '',
		'description'   => '',
		'date'          => '',
		'location'      => '',
		'note'          => '',
		'end'           => '',
		'photo_1_url'   => '',
		'photo_1_alt'   => '',
		'photo_2_url'   => '',
		'photo_2_alt'   => '',
	),
);

$events = array();

for ( $i = 1; $i <= 3; $i++ ) {
	$defaults = $slot_defaults[ $i ];
	$title    = get_theme_mod( 'milo_event_' . $i . '_title', $defaults['title'] );

	if ( '' === trim( (string) $title ) ) {
		continue;
	}

	$end_raw = get_theme_mod( 'milo_event_' . $i . '_end', $defaults['end'] );
	if ( '' === trim( (string) $end_raw ) ) {
		continue;
	}

	try {
		$end = new DateTimeImmutable( $end_raw, $pacific );
	} catch ( Exception $e ) {
		continue;
	}

	$photos = array();
	for ( $p = 1; $p <= 2; $p++ ) {
		$url = get_theme_mod( 'milo_event_' . $i . '_photo_' . $p . '_url', $defaults[ 'photo_' . $p . '_url' ] );
		if ( '' === trim( (string) $url ) ) {
			continue;
		}
		$photos[] = array(
			'url' => $url,
			'alt' => get_theme_mod( 'milo_event_' . $i . '_photo_' . $p . '_alt', $defaults[ 'photo_' . $p . '_alt' ] ),
		);
	}

	$events[] = array(
		'title'       => $title,
		'description' => get_theme_mod( 'milo_event_' . $i . '_description', $defaults['description'] ),
		'date'        => get_theme_mod( 'milo_event_' . $i . '_date', $defaults['date'] ),
		'location'    => get_theme_mod( 'milo_event_' . $i . '_location', $defaults['location'] ),
		'note'        => get_theme_mod( 'milo_event_' . $i . '_note', $defaults['note'] ),
		'end'         => $end,
		'photos'      => $photos,
	);
}

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

$count      = count( $events );
$list_class = 'milo-event__list';
if ( 2 === $count ) {
	$list_class .= ' milo-event__list--pair';
} elseif ( 3 === $count ) {
	$list_class .= ' milo-event__list--triple';
}
?>

<section class="milo-event" aria-labelledby="milo-event-heading">
	<h2 class="milo-event__eyebrow" id="milo-event-heading">
		<?php echo esc_html( _n( 'Upcoming Event', 'Upcoming Events', $count, 'mk_framework' ) ); ?>
	</h2>

	<ul class="<?php echo esc_attr( $list_class ); ?>">
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

				<?php if ( ! empty( $event['photos'] ) ) : ?>
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
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
