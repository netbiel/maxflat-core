<?php
/**
 * The template for displaying posts in the Quote post format
 */
?>
<div class="post-box">
	<div class="row">
		<div class="columns large-2 medium-2">

			<?php maxflat_replay_link(); ?>

		</div>
		<div class="columns large-14 medium-14">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php maxflat_display_meta_post('date'); ?>
				</header>


				<div class="entry-content">
					<blockquote><?php the_content(); ?></blockquote>
				</div>


			</article>
		</div>
	</div>
	<!-- #post -->
</div><!-- .post-box -->
