<?php
/**
 * The template for displaying all pages.
 *
 */

get_header(); ?>

<div id="content" class="<?php echo get_class_of_component('content') ?>" role="main">


    <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('content', 'page'); ?>
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