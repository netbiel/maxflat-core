<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>
<div class="smartlib-post-box">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<?php maxflat_category_line(); ?>
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>"
					 title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'maxflat'), the_title_attribute('echo=0'))); ?>"
					 rel="bookmark"><?php the_title(); ?></a>
			</h3>

			<?php maxflat_display_meta_post(); ?>
		</header>
		<!-- .entry-header -->
		<div class="row">
			<div class="columns large-16">
				<?php
				$featured_image = maxflat_get_featured_image( 'wide-image' );
				$post_format = get_post_format();
				if ('' != get_the_post_thumbnail()) {
					?>
					<a href="<?php the_permalink(); ?>" class="smartlib-thumbnail-outer"><?php maxflat_get_format_ico($post_format) ?><?php the_post_thumbnail('wide-image'); ?></a>

					<?php
				}else if ( $post_format == 'gallery' && !empty( $featured_image ) ) {
					?>
					<a href="<?php the_permalink(); ?>" class="smartlib-thumbnail-outer"><?php maxflat_get_format_ico($post_format) ?><?php echo $featured_image; ?></a>
					<?php
				}


				if (is_search()) : // Only display Excerpts for Search
					?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
					<?php else : ?>
					<div class="entry-content">
						<?php the_content(__('Continue reading', 'maxflat') . ' <i class="fa fa-angle-right"></i>'); ?>
						<?php maxflat_custom_single_page_pagination(); ?>
					</div><!-- .entry-content -->
					<?php endif; ?>
			</div>
		</div>



		<!-- .entry-meta -->
	</article>
	<!-- #post -->
</div><!-- .post-box -->
