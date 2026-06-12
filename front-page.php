<?php
get_header();
?>

<?php get_template_part( 'components/milo-hero' ); ?>

<?php
while ( have_posts() ) :
    the_post();
    the_content();
endwhile;

get_footer();