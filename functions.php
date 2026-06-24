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
