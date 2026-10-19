<?php
/**
 * Homepage banner.
 *
 * @package Jupiter_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="milo-banner">
	<p class="milo-banner__announcement">
		<?php echo wp_kses_post( __( '<b>Open for adoptions, fostering, and volunteering</b> Sunday, Monday, Wednesday, and Thursday, 11am-6pm and Friday and Saturday, 11am-5pm. Closed Tuesdays.', 'mk_framework' ) ); ?>
	</p>
	<p class="milo-banner__adoption-message">
		<?php echo esc_html__( 'Volunteers always encouraged! Come meet our fabulous rescued animals!', 'mk_framework' ); ?>
	</p>
</div>
