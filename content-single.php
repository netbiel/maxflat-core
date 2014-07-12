<?php
/**
 * The default template for displaying single content.
 *
 */
?>
<div class="post-box">
	<div class="row">
		<div class="columns large-2 medium-2">

      <?php maxflat_replay_link(); ?>
			<?php maxflat_entry_tags() ?>
		</div>
		<div class="columns large-14 medium-14">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php maxflat_category_line(); ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php maxflat_display_meta_post('date'); ?>
				</header>
				<div class="smartlib-single-image-container">

						<?php the_post_thumbnail( 'wide-image' ); ?>

				</div>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<?php maxflat_custom_single_page_pagination(); ?>
				<footer class="entry-meta">
				<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">

					<?php get_template_part( 'views/snippets/author_info' ); ?>

				</div><!-- .author-info -->
				<?php endif; ?>
				</footer>
			</article>
		</div>
	</div>
	<!-- #post -->
</div><!-- .post-box -->
