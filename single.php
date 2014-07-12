<?php
/**
 * The Template for displaying all single posts.
 */

get_header();
$category = get_the_category();
?>

<div id="content" class="<?php echo get_class_of_component('content') ?>" role="main">

    <?php while (have_posts()) : the_post(); ?>

    <?php
    if (get_post_format()) {
        get_template_part('content', get_post_format());
    } else {
        get_template_part('content', 'single');
    }
    ?>

    <?php maxflat_prev_next_post_navigation(); ?>

	   <?php maxflat_get_related_post_box($category[0]->cat_ID, get_the_ID(), 8, 4); ?>

    <?php comments_template('', true); ?>

    <?php endwhile; // end of the loop. ?>

</div><!-- #content -->
<?php
if(check_position_of_component('menu', 'right')){
	get_template_part('section', 'menu');
}//if menu is large-1 the right side
?>
</div><!-- #main -->

</div><!-- #page -->

<?php
//add sidebar on the right side
if(check_position_of_component('sidebar', 'right'))
	get_sidebar();
?>
</div><!-- #wrapper -->
<?php get_footer(); ?>