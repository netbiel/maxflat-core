<div class="<?php echo get_class_of_component('menu') ?>">
<nav id="site-navigation" class="main-navigation hide-for-small" role="navigation">

<a class="assistive-text" href="#content"
		title="<?php esc_attr_e( 'Skip to content', 'maxflat' ); ?>"><?php _e( 'Skip to content', 'maxflat' ); ?></a>
	<?php
	//fixed menu option
	$fixed = __MAXFLAT::option( 'maxflat_menu_fixed' );
?>
<div class="maxflat-nav-menu <?php echo $fixed=='1'? ' fixed-menu':'' ?>">
	<?php wp_nav_menu( array( 'theme_location' => 'categories', 'container' => false ) ); ?>
</div>
</nav>

<!-- #site-navigation -->

	<ul class="widget-area smartlib-under-menu-widget-area">
		<?php
		dynamic_sidebar('sidebar-6');
		?>
	</ul>
</div>

