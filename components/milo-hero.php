<?php
/**
 * Homepage hero.
 *
 * Content is editable under Appearance → Customize → Homepage Hero.
 *
 * @package Jupiter_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uploads = content_url( 'uploads/2026/02' );

$heading    = get_theme_mod( 'milo_hero_heading', __( 'Welcome to Milo Foundation', 'mk_framework' ) );
$subheading = get_theme_mod( 'milo_hero_subheading', __( 'Help save a homeless pet today!', 'mk_framework' ) );

$images = array(
	'desktop' => get_theme_mod( 'milo_hero_image_desktop', $uploads . '/hueser024-scaled-e1773116240641-1920x675.jpg' ),
	'tablet'  => get_theme_mod( 'milo_hero_image_tablet', $uploads . '/hueser024-scaled-e1773116240641-1024x360.jpg' ),
	'mobile'  => get_theme_mod( 'milo_hero_image_mobile', $uploads . '/hueser024-scaled-e1773116240641-736x414.jpg' ),
);

$buttons = array(
	array(
		'label'   => get_theme_mod( 'milo_hero_button_1_label', __( 'Adopt', 'mk_framework' ) ),
		'url'     => get_theme_mod( 'milo_hero_button_1_url', home_url( '/pet-adoption-application/' ) ),
		'primary' => true,
	),
	array(
		'label'   => get_theme_mod( 'milo_hero_button_2_label', __( 'Foster', 'mk_framework' ) ),
		'url'     => get_theme_mod( 'milo_hero_button_2_url', home_url( '/dog-cat-foster-program/' ) ),
		'primary' => false,
	),
	array(
		'label'   => get_theme_mod( 'milo_hero_button_3_label', __( 'Support', 'mk_framework' ) ),
		'url'     => get_theme_mod( 'milo_hero_button_3_url', home_url( '/donate/' ) ),
		'primary' => false,
	),
);
?>

<section class="milo-hero">
	<picture class="milo-hero__media">
		<source media="(max-width: 767px)" srcset="<?php echo esc_url( $images['mobile'] ); ?>">
		<source media="(max-width: 1024px)" srcset="<?php echo esc_url( $images['tablet'] ); ?>">
		<img
			class="milo-hero__image"
			src="<?php echo esc_url( $images['desktop'] ); ?>"
			alt=""
			decoding="async"
			fetchpriority="high"
		>
	</picture>

	<div class="milo-hero__overlay" aria-hidden="true"></div>

	<div class="milo-hero__content">
		<h1 class="milo-hero__heading"><?php echo esc_html( $heading ); ?></h1>
		<p class="milo-hero__subheading"><?php echo esc_html( $subheading ); ?></p>

		<div class="milo-hero__buttons">
			<?php foreach ( $buttons as $button ) : ?>
				<a
					class="milo-hero__btn <?php echo $button['primary'] ? 'milo-hero__btn--primary' : 'milo-hero__btn--secondary'; ?>"
					href="<?php echo esc_url( $button['url'] ); ?>"
				>
					<?php echo esc_html( $button['label'] ); ?> &gt;
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
