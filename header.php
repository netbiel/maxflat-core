<!DOCTYPE html>
<!--[if lt IE 9]>
<html class="ie lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php

    wp_head();
    ?>

</head>

<body <?php body_class(); ?>>
<?php maxflat_lt_ie7_info(); //display info if IE lower than 7  ?>
<div class="top-bar-outer">
	<?php
	//fixed top bar option
	$fixed = __MAXFLAT::option( 'project_fixed_topbar' );
	?>

<div id="top-bar" class="top-bar home-border<?php get_header_fixed_class(); ?>">

	<div class="row">
		<div class="columns large-4 medium-3  small-6">
            <?php
            /**
             * Add Theme logo : template_tags
             */
            maxflat_logo()
            ?>
    </div>


		<div class="columns large-12 medium-13 small-10">
			<!--falayout search menu-->
			<?php maxflat_searchmenu(); //display search menu ?>

			<nav id="top-navigation" class="left show-for-large-up">
				<a class="maxflat-wai-info maxflat-skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'maxflat' ); ?>"><?php _e( 'Skip to content', 'maxflat' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'top_pages', 'menu_class' => 'maxflat-menu maxflat-top-menu' ) ); ?>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="columns large-16 smartlib-toggle-area" id="toggle-search">
			<?php maxflat_searchform(); //display toggle form search  ?>
		</div>
	</div>
</div>
</div>
<div id="wrapper" class="row">

	<?php
//if sidebar is large-1 the left side
		if(check_position_of_component('sidebar', 'left'))
			get_sidebar();

	?>
	<div id="page" role="main" class="<?php echo get_class_of_component('page') ?>">
		<?php
        maxflat_get_header(); //display header info or header image
		    maxflat_breadcrumb();

		?>
		<div id="main" class="row">
			<nav id="mobile-navigation" class="columns large-16 show-for-small" role="navigation">
				<?php

				//display mobile menu
                    maxflat_mobile_menu(
					array(
						'theme_location' => 'categories'
					)
				);

				?>

			</nav>




