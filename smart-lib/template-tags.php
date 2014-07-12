<?php


/**
 *
 * MaxFlat helper functions.
 *
 * Provides some helper functions, which are used  in the theme as custom template tags.
 *

 *
 * @since      MaxFlat 1.0
 */


function maxflat_breadcrumb(){
	?>
		<div class="smartlib-breadcrumb">
	   <?php __MAXFLAT::layout()->get_the_bredcrumb(); ?>
		</div>
	<?php
}

/**
 * Print logo theme
 *
 * @return mixed
 */
function maxflat_logo(){
   if(is_front_page()){
		 $header_tag = 'h1';
	 }else{
		 $header_tag = 'h4';
	 }
  echo '<'.$header_tag.' class="smartlib-logo-header">';
	?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				 title="<?php echo  get_bloginfo( 'name', 'display' ) ; ?>"
				 rel="home"
				 class="smartlib-site-logo <?php echo ( strlen(__MAXFLAT::option('project_logo') ) > 0 ) ? 'image-logo' : ''; ?>">
				<?php
				if ( strlen( __MAXFLAT::option('project_logo') ) > 0 ) {
                    ?>
                    <img src="<?php echo __MAXFLAT::option('project_logo'); ?>"
                         alt="<?php echo bloginfo( 'name' ); ?>" />
                <?php
                }
                else {
                    bloginfo( 'name' );
                }
				?></a>
	<?php
	echo '</'.$header_tag.'>';
}

/**
 * Display Layout header - banner or Site description
 * @return mixed
 */

function maxflat_get_header(){
	return __MAXFLAT::layout()->get_site_header();
}

/**
Prints HTML category line
 */
function maxflat_category_line(){
	?>
<span class="smartlib-category-line">
	<?php echo __MAXFLAT::layout()->category_line(); ?>
</span>
<?php

}



/**
 * Display pagination on the loop page
 *
 * @param $html_id
 *
 * @return mixed
 */
function maxflat_list_pagination( $html_id){
	return __MAXFLAT::layout()->pagination_nav( $html_id);
}

/**
 * Displays navigation to next/previous post on single  page.
 */

function maxflat_prev_next_post_navigation(){
	return __MAXFLAT::layout()->single_prev_next();
}


/**
 * Modyfication wp_link_pages() - <!--nextpage--> pagination
 * @return mixed
 */
function maxflat_custom_single_page_pagination(){
	return __MAXFLAT::layout()->custom_wp_link_pages();
}

/**
 *
 * Display comment components
 *
 * @param $comment
 * @param $args
 * @param $depth
 *
 * @return mixed
 */
function maxflat_comment_component( $comment, $args, $depth ){
	return __MAXFLAT::layout()->comment_component( $comment, $args, $depth );
}

/**
 * Display Date in post loop
 * @return mixed
 */
function maxflat_get_date(){
    return __MAXFLAT::layout()->display_date();
}

/**
 * Display post image from gallery
 * @param $size
 * @return mixed
 */
function maxflat_get_featured_image($size){
    return __MAXFLAT::layout()->get_featured_image($size);
}

/**
 * add IE 7 & IE 8 CSS3 Box-sizing support
 *
 * @since MaxFlat 1.0
 *
 */

function maxflat_ie_support()
{

    ?><!--[if IE 7]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font/css/font-awesome-ie7.min.css">
<![endif]-->
<!--[if IE 7]>
<style>
    * {
    * behavior : url (<?php echo get_template_directory_uri(); ?>/js/boxsize-fix.htc );
    }
</style>
<![endif]-->
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php

}

/*
 * Return excerpt with limit
 */
function maxflat_excerpt_max_charlength( $charlength ) {
	$excerpt = get_the_excerpt();
	$charlength ++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex   = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut   = - ( mb_strlen( $exwords[count( $exwords ) - 1] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		}
		else {
			echo $subex;
		}
		echo '...';
	}
	else {
		echo $excerpt;
	}
}



/**
 * Return custom_code_header
 *
 *
 * @return string
 */
function maxflat_option_custom_code_header(){
	__MAXFLAT::option( 'custom_code_header');

}

/**
Retrieves project_fixed_top bar option and get fixed class
 */
function get_header_fixed_class(){
	$fixed = __MAXFLAT::option( 'project_fixed_topbar' );
   echo $fixed=='1'? ' smartlib-fixed-top-bar':'';
}

/**
 * Display lt ie7 info
 */

function maxflat_lt_ie7_info() {
	?>
<!--[if lt IE 7]>
<p class=chromeframe>Your browser is <em>ancient!</em> Upgrade to a
    different browser.
</p>
<![endif]-->
<?php
}

/**
 * Display search menu
 */
function maxflat_searchmenu() {
	?>
<ul id="top-switches" class="no-bullet right">
	<li>
		<a href="#toggle-search" class="maxflat-toggle-topbar toggle-button button">
			<span class="fa fa-search"></span>
		</a>
	</li>
	<li class="hide-for-large">
		<a href="#top-navigation" class="maxflat-toggle-topbar toggle-button button">
			<span class="fa fa-align-justify"></span>
		</a>
	</li>
</ul>
<?php
}

/**
 * Display search form
 */

function maxflat_searchform() {
	?>
<form action="<?php echo home_url( '/' ); ?>" method="get" role="search" id="smartlib-top-search-container">
	<div class="row">
		<div class="columns sixteen mobile-four">
			<input id="search-input" type="text" name="s"
						 placeholder="<?php _e( 'Search for ...',  __MAXFLAT::domain() ); ?>" value="">
			<input class="button" id="top-searchsubmit" type="submit"
						 value="<?php _e( 'Search', __MAXFLAT::domain() ); ?>">
		</div>
	</div>

</form>
<?php
}

/*
 *  Add dynamic select menus  for mobile device navigation * *
 *
 * @since Maxflat 1.0
 * @link: http://kopepasah.com/tutorials/creating-dynamic-select-menus-in-wordpress-for-mobile-device-navigation/
 *
 * @param array $args
 *
*/

function  maxflat_mobile_menu($args=array()){



	$defaults = array(
		'theme_location' => '',
		'menu_class'     => 'mobile-menu',
	);

	$args           = wp_parse_args( $args, $defaults );

	$menu_item = __MAXFLAT::layout()->wp_nav_menu_select($args);

	if($menu_item){
	?>

	<select id="menu-<?php echo $args['theme_location'] ?>" class="<?php echo $args['menu_class'] ?>">
			<option value=""><?php _e( '- Select -', 'maxflat'); ?></option>
			<?php foreach ( $menu_item as $id => $data ) : ?>
	<?php if ( $data['parent'] == true ) : ?>
		<optgroup label="<?php echo $data['item']->title ?>">
			<option value="<?php echo $data['item']->url ?>"><?php echo $data['item']->title ?></option>
			<?php foreach ( $data['children'] as $id => $child ) : ?>
			<option value="<?php echo $child->url ?>"><?php echo $child->title ?></option>
			<?php endforeach; ?>
		</optgroup>
		<?php else : ?>
		<option value="<?php echo $data['item']->url ?>"><?php echo $data['item']->title ?></option>
		<?php endif; ?>
	<?php endforeach; ?>
		</select>
		<?php
	}else{
		?>
	<select class="menu-not-found">
		<option value=""><?php _e( 'Menu Not Found', 'maxflat'); ?></option>
	</select>
			<?php
	}

}

/**
 * Returns an occurrence of the element at a given position
 */

function check_position_of_component( $component, $side) {
		return __MAXFLAT::layout()->check_position_of_component($component, $side);
}

/**
 * Returns the class of the given object
 */

function get_class_of_component( $component ) {
	return __MAXFLAT::layout()->get_class_of_component($component);
}


/**
 * Returns the image representing the gallery
 * @param $size
 *
 * @return mixed
 */
function maxflat_featured_image($size= 'full' ) {
	return __MAXFLAT::layout()->get_featured_image( $size  );
}


/**
 * Include the category specific template for the content
 */
function maxflat_template_category_loop() {

	$category_id     = get_query_var( 'cat' );
	$category_option = get_option( 'category_' . $category_id );

	$category_template = $category_option['layout'] == 2 ? 'loop-2columns' : 'loop';

  return $category_template;
}


/**
 *
 * Display related posts component
 * @param     $category
 * @param     $post_ID
 * @param     $display_post_limit
 * @param int $columns_per_slide
 *
 * @return mixed
 */

function maxflat_get_related_post_box( $category, $post_ID, $display_post_limit, $columns_per_slide = 4 ) {
	$query =  __MAXFLAT::layout()->get_related_post_box($category, $post_ID, $display_post_limit, $columns_per_slide);

	$limit= $query->found_posts;
	if ( $limit != 0) {

		?>
	<section class="smartlib-related-posts">
	    <h3><?php _e( 'Related posts', 'maxflat' ) ?></h3>
			<div class="smartlib-slider-container">
				<ul class="smartlib-slides slider-list slides">
					<?php
					$i = 1;
					$j = 1;
					while ( $query->have_posts() ) {
						$query->the_post();
						$post_format = get_post_format();
						if ( $i == 1 ) {
							?>
								<li class="row">
								<?php
						}
						?>
						<div class="columns large-4">
							<?php
							if ( '' != get_the_post_thumbnail() ) {
								?>

									<a href="<?php the_permalink(); ?>" class="smartlib-thumbnail-outer"
										 title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'maxflat' ), the_title_attribute( 'echo=0' ) ) ); ?>"
											><?php maxflat_get_format_ico($post_format) ?><?php the_post_thumbnail( 'medium-image-thumb' ); ?></a>

								<?php
							}
							elseif ( $post_format == 'gallery' ) {
								$featured_image = maxflat_get_featured_image( 'medium-image-thumb' );

								if ( ! empty( $featured_image ) ) {
									?>


										<a href="<?php the_permalink(); ?>" class="smartlib-thumbnail-outer"
											 title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'maxflat' ), the_title_attribute( 'echo=0' ) ) ); ?>"
												><?php maxflat_get_format_ico($post_format) ?><?php echo $featured_image ?></a>

									<?php
								}
							}

							?>
							<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
							<?php if ( empty( $featured_image ) && '' == get_the_post_thumbnail() ) { ?>
						<?php maxflat_display_meta_post('author') ?>
							<?php } ?>
						</div>

						<?php
						if ( $i % $columns_per_slide == 0 || $j == $limit ) {
					   ?>
						</li>
								<?php
							$i = 1;
						}
						else {
							$i ++;
						}

						$j ++;

					}// end while
                    wp_reset_postdata();
					?>
				</ul>
			</div>


	</section>
		<?php
		}
}

/**
 * Display sidebar with grid elements
 *
 * @param int $index
 *
 * @return mixed
 */
function maxflat_dynamic_sidebar_grid($index=1){
	return __MAXFLAT::layout()->dynamic_sidebar_grid($index);
}

/**
 * Return awesome icon based on key_class
 *
 * @param $key_class
 */
function maxflat_get_awesome_ico($key_class){
		$class_name = __MAXFLAT::layout()->get_awesome_icon_class($key_class);
	  ?>
    <i class="<?php echo $class_name ?>"></i>
		<?php
}

/**
 * Display format (gallery, video) icon
 *
 * @param $key_class
 */
function maxflat_get_format_ico($key_class){
	$class_name = __MAXFLAT::layout()->get_awesome_icon_class($key_class);
	$formats_array = __MAXFLAT::layout()->get_promoted_formats();
	if(in_array($key_class, $formats_array)){
	?>
		<span class="smartlib-format-ico"><i class="<?php echo $class_name ?>"></i></span>
	<?php
	}

}
/**
 *
 * Display meta line under post title
 *
 * @param string $type author|category|date
 */
function maxflat_display_meta_post($type='author'){
	global $post;
	?>

<p class="meta-line">
       <?php echo maxflat_get_date() ?>
	<?php
	$post_format = get_post_format( $post->ID );

	$speacial_formats = array(
		'gallery', 'video'
	);
	if(in_array($post_format, $speacial_formats )){
		?>
		<span class="meta-label smartlib-postformat-info"><?php maxflat_get_awesome_ico($post_format) ?> <?php echo ucfirst ($post_format) ?></span>
			<?php
	}

	if($type=='author'){
		 maxflat_author_line();
	}else if($type=='category'){
		maxflat_category_line();
	}
?>


</p>
		<?php
}
/*
 * Print author line
 */
function maxflat_author_line(){
	?>
<span class="meta-label meta-publisher vcard"><?php _e('Published by: ', 'maxflat') ?> <?php the_author_posts_link(); ?> </span>
		<?php
}

/**
 Prints tag line with HTML
 */
function maxflat_entry_tags(){
	?>
<?php if ( has_tag() ): ?>
	<div class="smartlib-tags-article"> <?php maxflat_get_awesome_ico('tag_icon')?> <?php the_tags( __( 'Tags: ', 'maxflat' ), '  ' ); ?></div>
	<?php endif ?>
		<?php
}

/**
 Prints leave replay button
 */
function maxflat_replay_link(){
	?>
<div class="smartlib-comments-link">
	<?php if ( comments_open() && is_single() ) { ?>
	<?php comments_popup_link( __( 'Comment', 'maxflat' ) .'<i class="'.maxflat_get_awesome_ico('comments').'"></i></span>', __( '1 Reply', 'maxflat' ), __( '% Replies', 'maxflat' ) ); ?>
	<?php } ?>
</div>
		<?php
}


?>