<?php
/**
 * The 2 columns template for displaying content.
 */
?>
<div class="post-box columns large-8 column-box">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


        <header class="entry-header">
            <div class="top-meta">
                <?php maxflat_category_line(); ?>
            </div>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>"
                   title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'maxflat'), the_title_attribute('echo=0'))); ?>"
                   rel="bookmark"><?php the_title(); ?></a>
            </h2>
					<?php maxflat_display_meta_post(); ?>
        </header>
        <!-- .entry-header -->
        <div class="row">
            <div class="columns large-16">
                <?php
							$post_format = get_post_format();


                if ('' != get_the_post_thumbnail()) {
                    ?>
                   <div class="smartlib-thumbnail-outer"><?php maxflat_get_format_ico($post_format) ?><a href="<?php the_permalink(); ?>"
																																										 title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'maxflat'), the_title_attribute('echo=0'))); ?>"
																																										 ><?php the_post_thumbnail('medium-square'); ?></a></div>

                    <?php
                }elseif($post_format=='gallery'){
									$featured_image = maxflat_featured_image('medium-square');
									if(!empty($featured_image)){
									?>

									<div class="smartlib-thumbnail-outer"><?php maxflat_get_format_ico($post_format) ?><a href="<?php the_permalink(); ?>"
																																												 title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'maxflat'), the_title_attribute('echo=0'))); ?>"
											><?php echo $featured_image ?></a></div>

									<?php
									}
								}
                if (is_search()) : // Only display Excerpts for Search
                    ?>
                    <div class="entry-summary">
										<?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
                    <?php else : ?>
                    <div class="entry-content">
										<?php the_content(__('Continue reading', 'maxflat') . ' <i class="fa fa-angle-right"></i>'); ?>
										 </div><!-- .entry-content -->
                    <?php endif; ?>
            </div>
        </div>

        <!-- .entry-meta -->
    </article>
    <!-- #post -->
</div><!-- .post-box -->
