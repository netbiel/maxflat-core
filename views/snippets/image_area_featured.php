<?php
/*
* Image row snippet
*/
?>

	<?php

   $featured_image =  maxflat_get_featured_image( 'medium-square' );

	if ( '' != get_the_post_thumbnail() ) {
		?>
		<div class="smartlib-featured-image-container">

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium-square' ); ?></a>

		</div>
		<?php
	}else if ( ! empty( $featured_image ) ) {
		?>
	<div class="smartlib-featured-image-container">
		<a href="<?php the_permalink(); ?>"><?php echo $featured_image; ?></a>
	</div>
			<?php
	}
	?>
