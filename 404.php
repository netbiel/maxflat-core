<?php
/**
 * Template for displaying 404 pages (Not Found).
 */

get_header(); ?>

<div id="content" class="<?php echo get_class_of_component('content') ?>" role="main">


	<?php while (have_posts()) : the_post(); ?>
	<div class="entry-content">
		<p><?php _e('Apologies, but no results were found. Perhaps searching will help find a related post.', 'maxflat'); ?></p>
		<?php get_search_form(); ?>
	</div>
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