<?php
/*
* Image row snippet
*/
?>

	<?php

   $featured_image =  maxflat_get_featured_image( 'wide-image' );

	if ('' != get_the_post_thumbnail() ) {
		?>
		<div class="smartlib-single-image-container">

					<?php the_post_thumbnail( 'wide-image' ); ?>

		</div>
		<?php
	}else if ( ! empty( $featured_image ) ) {
		?>
	<div class="smartlib-single-image-container">
	  <?php echo $featured_image; ?>
	</div>
			<?php
	}
	?>
