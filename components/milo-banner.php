<?php
/**
 * Homepage banner.
 *
 * Content is editable under Appearance → Customize → Homepage Banner.
 *
 * @package Jupiter_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$announcement = get_theme_mod(
	'milo_banner_announcement',
	__( '<b>Open for adoptions, fostering, and volunteering</b> Sunday, Monday, Wednesday, and Thursday, 11am-6pm and Friday and Saturday, 11am-5pm. Closed Tuesdays.', 'mk_framework' )
);
$adoption_message = get_theme_mod(
	'milo_banner_adoption_message',
	__( 'Volunteers always encouraged! Come meet our fabulous rescued animals!', 'mk_framework' )
);
?>

<div class="milo-banner">
	<p class="milo-banner__announcement">
		<?php echo wp_kses_post( $announcement ); ?>
	</p>
	<p class="milo-banner__adoption-message">
		<?php echo esc_html( $adoption_message ); ?>
	</p>
</div>
