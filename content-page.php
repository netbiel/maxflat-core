<?php
/**
 * The template used for displaying page content in page.php
 */
?>
<div class="post-box">
	<div class="row">

		<div class="columns large-16 medium-16">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">

					<h1 class="entry-title"><?php the_title(); ?></h1>

				</header>
				<?php get_template_part('views/snippets/image_area') ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<?php maxflat_custom_single_page_pagination(); ?>

			</article>
		</div>
	</div>
	<!-- #post -->
</div><!-- .post-box -->
