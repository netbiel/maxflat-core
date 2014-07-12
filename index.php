<?php
/**
 * MaxFlat main template file.
 *
 *
 *
 * @since      MaxFlat 1.0
 */

get_header(); ?>


<div id="content" class="<?php echo get_class_of_component('content') ?>" role="main">
	<?php if ( have_posts() ) : ?>

	<?php /* start the loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if (is_sticky() && is_home() && !is_paged()) : ?>
				<?php
			//include featured post template
			get_template_part( 'content', 'featured'); ?>
		<?php else: ?>
				<?php
			get_template_part( 'content'); ?>
		<?php endif; ?>
		<?php endwhile;

        maxflat_list_pagination( 'nav-below' );

	?>
	<?php else : ?>
	<article id="post-0" class="post no-results not-found">

	<?php get_template_part( 'content', 'none'); ?>

	<?php endif; // end have_posts() check ?>

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
