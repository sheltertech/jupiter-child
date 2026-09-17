<?php
/**
 * Homepage event announcement.
 *
 * @package Jupiter_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// The announcement removes itself once the event has ended.
$event_end = new DateTimeImmutable( '2026-09-19 14:00', wp_timezone() );

if ( current_datetime() > $event_end ) {
	return;
}

$uploads = content_url( 'uploads/2026/09' );

$photos = array(
	array(
		'url' => $uploads . '/img_1961-768x1024.jpg',
		'alt' => __( 'A fluffy red and white husky mix sitting on a sidewalk with her tongue out.', 'mk_framework' ),
	),
	array(
		'url' => $uploads . '/img_2523-768x1024.jpg',
		'alt' => __( 'A brindle hound mix with a white muzzle standing in the grass.', 'mk_framework' ),
	),
	array(
		'url' => $uploads . '/20260827_153406-768x1024.jpg',
		'alt' => __( 'A shaggy cream coated poodle mix standing on a sidewalk by an iron fence.', 'mk_framework' ),
	),
);

?>

<section class="milo-event" aria-labelledby="milo-event-title">
	<div class="milo-event__inner">
		<p class="milo-event__eyebrow">Upcoming Event</p>
		<h2 class="milo-event__title" id="milo-event-title">Find your forever furry friend at our Woodlands adoption event!</h2>
		<p class="milo-event__details">September 19, 2026 &middot; 11:30AM&ndash;2:00PM</p>
		<p class="milo-event__location">Woodlands Pet Food &amp; Treats &middot; 296 Bon Air Center, Greenbrae, CA 94904</p>

		<ul class="milo-event__photos">
			<?php foreach ( $photos as $photo ) : ?>
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
	</div>
</section>
