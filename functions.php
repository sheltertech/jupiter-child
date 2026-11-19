<?php
/**
 * Jupiter child theme functions.
 *
 * @package Jupiter_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue the event announcement styles.
 *
 * @return void
 */
function milo_enqueue_event_styles() {
	$relative = '/components/milo-event.css';
	$path     = get_stylesheet_directory() . $relative;

	if ( ! file_exists( $path ) ) {
		return;
	}

	wp_enqueue_style(
		'milo-event',
		get_stylesheet_directory_uri() . $relative,
		array(),
		filemtime( $path )
	);
}
add_action( 'wp_enqueue_scripts', 'milo_enqueue_event_styles', 20 );

/**
 * Register Customizer settings for the homepage hero.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 * @return void
 */
function milo_hero_customize_register( $wp_customize ) {
	$uploads = content_url( 'uploads/2026/02' );

	$wp_customize->add_section(
		'milo_hero',
		array(
			'title'       => __( 'Homepage Hero', 'mk_framework' ),
			'description' => __( 'Controls the hero at the top of the homepage.', 'mk_framework' ),
			'priority'    => 30,
		)
	);

	$wp_customize->add_setting(
		'milo_hero_heading',
		array(
			'default'           => __( 'Welcome to Milo Foundation', 'mk_framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'milo_hero_heading',
		array(
			'label'   => __( 'Heading', 'mk_framework' ),
			'section' => 'milo_hero',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'milo_hero_subheading',
		array(
			'default'           => __( 'Help save a homeless pet today!', 'mk_framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'milo_hero_subheading',
		array(
			'label'   => __( 'Subheading', 'mk_framework' ),
			'section' => 'milo_hero',
			'type'    => 'text',
		)
	);

	$image_defaults = array(
		'milo_hero_image_desktop' => $uploads . '/hueser024-scaled-e1773116240641-1920x675.jpg',
		'milo_hero_image_tablet'  => $uploads . '/hueser024-scaled-e1773116240641-1024x360.jpg',
		'milo_hero_image_mobile'  => $uploads . '/hueser024-scaled-e1773116240641-736x414.jpg',
	);

	$image_labels = array(
		'milo_hero_image_desktop' => __( 'Desktop image URL', 'mk_framework' ),
		'milo_hero_image_tablet'  => __( 'Tablet image URL', 'mk_framework' ),
		'milo_hero_image_mobile'  => __( 'Mobile image URL', 'mk_framework' ),
	);

	foreach ( $image_defaults as $id => $default ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $default,
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'       => $image_labels[ $id ],
				'description' => __( 'Paste a full image URL from the Media Library.', 'mk_framework' ),
				'section'     => 'milo_hero',
				'type'        => 'url',
			)
		);
	}

	$button_defaults = array(
		1 => array(
			'label' => __( 'Adopt', 'mk_framework' ),
			'url'   => home_url( '/pet-adoption-application/' ),
		),
		2 => array(
			'label' => __( 'Foster', 'mk_framework' ),
			'url'   => home_url( '/dog-cat-foster-program/' ),
		),
		3 => array(
			'label' => __( 'Support', 'mk_framework' ),
			'url'   => home_url( '/donate/' ),
		),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting(
			'milo_hero_button_' . $i . '_label',
			array(
				'default'           => $button_defaults[ $i ]['label'],
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'milo_hero_button_' . $i . '_label',
			array(
				'label'   => sprintf(
					/* translators: %d: button number */
					__( 'Button %d label', 'mk_framework' ),
					$i
				),
				'section' => 'milo_hero',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'milo_hero_button_' . $i . '_url',
			array(
				'default'           => $button_defaults[ $i ]['url'],
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'milo_hero_button_' . $i . '_url',
			array(
				'label'   => sprintf(
					/* translators: %d: button number */
					__( 'Button %d URL', 'mk_framework' ),
					$i
				),
				'section' => 'milo_hero',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'milo_hero_customize_register' );

/**
 * Register Customizer settings for the homepage banner.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 * @return void
 */
function milo_banner_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'milo_banner',
		array(
			'title'       => __( 'Homepage Banner', 'mk_framework' ),
			'description' => __( 'Controls the announcement banner at the top of the homepage.', 'mk_framework' ),
			'priority'    => 31,
		)
	);

	$wp_customize->add_setting(
		'milo_banner_announcement',
		array(
			'default'           => __( '<b>Open for adoptions, fostering, and volunteering</b> Sunday, Monday, Wednesday, and Thursday, 11am-6pm and Friday and Saturday, 11am-5pm. Closed Tuesdays.', 'mk_framework' ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'milo_banner_announcement',
		array(
			'label'   => __( 'Announcement', 'mk_framework' ),
			'section' => 'milo_banner',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'milo_banner_adoption_message',
		array(
			'default'           => __( 'Volunteers always encouraged! Come meet our fabulous rescued animals!', 'mk_framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'milo_banner_adoption_message',
		array(
			'label'   => __( 'Adoption message', 'mk_framework' ),
			'section' => 'milo_banner',
			'type'    => 'text',
		)
	);
}
add_action( 'customize_register', 'milo_banner_customize_register' );

/**
 * Register Customizer settings for homepage events.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 * @return void
 */
function milo_events_customize_register( $wp_customize ) {
	$uploads = content_url( 'uploads/2026/09' );

	$wp_customize->add_section(
		'milo_events',
		array(
			'title'       => __( 'Homepage Events', 'mk_framework' ),
			'description' => __( 'Up to three upcoming events. Clear a title to hide that slot. End times use Pacific time (Y-m-d H:i) and hide the event after they pass.', 'mk_framework' ),
			'priority'    => 32,
		)
	);

	$defaults = array(
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

	$fields = array(
		'title'       => array(
			'label'             => __( 'Title', 'mk_framework' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'description' => array(
			'label'             => __( 'Description', 'mk_framework' ),
			'type'              => 'textarea',
			'sanitize_callback' => 'wp_kses_post',
		),
		'date'        => array(
			'label'             => __( 'Date (display)', 'mk_framework' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
		),
		'location'    => array(
			'label'             => __( 'Location', 'mk_framework' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
		),
		'note'        => array(
			'label'             => __( 'Note', 'mk_framework' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'end'         => array(
			'label'             => __( 'End datetime (Pacific, Y-m-d H:i)', 'mk_framework' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'photo_1_url' => array(
			'label'             => __( 'Photo 1 URL', 'mk_framework' ),
			'type'              => 'url',
			'sanitize_callback' => 'esc_url_raw',
		),
		'photo_1_alt' => array(
			'label'             => __( 'Photo 1 alt text', 'mk_framework' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'photo_2_url' => array(
			'label'             => __( 'Photo 2 URL', 'mk_framework' ),
			'type'              => 'url',
			'sanitize_callback' => 'esc_url_raw',
		),
		'photo_2_alt' => array(
			'label'             => __( 'Photo 2 alt text', 'mk_framework' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
		),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		foreach ( $fields as $key => $field ) {
			$id = 'milo_event_' . $i . '_' . $key;
			$wp_customize->add_setting(
				$id,
				array(
					'default'           => $defaults[ $i ][ $key ],
					'sanitize_callback' => $field['sanitize_callback'],
					'transport'         => 'refresh',
				)
			);
			$wp_customize->add_control(
				$id,
				array(
					'label'   => sprintf(
						/* translators: 1: event number, 2: field label */
						__( 'Event %1$d %2$s', 'mk_framework' ),
						$i,
						$field['label']
					),
					'section' => 'milo_events',
					'type'    => $field['type'],
				)
			);
		}
	}
}
add_action( 'customize_register', 'milo_events_customize_register' );
