<?php
/**
 * The  template for displaying featured content
 */
?>
<div class="smartlib-featured-post-box">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php maxflat_author_line(); ?>
        <header class="entry-header">


            <h3 class="entry-title">
                <a href="<?php the_permalink(); ?>"
                   title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'maxflat'), the_title_attribute('echo=0'))); ?>"
                   rel="bookmark"><?php the_title(); ?></a>
            </h3>

					<?php maxflat_display_meta_post('data'); ?>
        </header>
        <!-- .entry-header -->

			<?php get_template_part('views/snippets/image_area_featured') ?>



        <!-- .entry-meta -->
    </article>
    <!-- #post -->
</div><!-- .post-box -->
