/**
 * Theme functions file
 */

(function ($) {
	"use strict";

	jQuery(document).ready(function ($) {

		//initialize foundation
		$(document).foundation();

		if($('.smartlib-slider-container').length>0){
			$('.smartlib-slider-container').flexslider();
		}

		/*sticky post initialize*/
		modifyStickyBox();

		$('.maxflat-toggle-topbar').click(function (e) {
			var container_expand = $(this).attr('href');
			var toggle_container = $('.smartlib-toggle-area');
			var top_menu = $('#top-navigation');
			var search_container = $('#smartlib-top-search-container');
			var link = $(this);


			link.toggleClass('active-toggle');

			if(container_expand=='#top-navigation'){

					if(link.hasClass('active-toggle')){
						top_menu.removeClass('show-for-large-up');
				  }else{
						top_menu.addClass('show-for-large-up');
					}
			}else if(container_expand=='#toggle-search'){

				toggle_container.toggleClass('show-container');

				if(toggle_container.hasClass('show-container')){
					search_container.show();
				}else{
					search_container.hide();
				}
			}






			e.preventDefault();
		});

		if ('embed') {

			$("embed").each(function (index) {
				var height = $(this).attr('height');
				var width = $(this).attr('width');

				$(this).width(width);
				$(this).height(height);
			});

		}
		/*ADD photoswipe*/
		if ($(".gallery-icon a").length != 0)
			var myPhotoSwipe = $(".gallery-icon a").photoSwipe({ enableMouseWheel:false, enableKeyboard:false, captionAndToolbarAutoHideDelay:0, captionAndToolbarFlipPosition:true });
		//fixed menu
		var nav = $('.fixed-menu');
		var max_margin = $('#page').height();
		var front_page_header_height = $('.frontpage-header').height();
		$(window).scroll(function () {
			var scrollTop = $(this).scrollTop();
			if (scrollTop > 230) {
				if (scrollTop < max_margin - 230)
					nav.css("margin-top", scrollTop - 70 - front_page_header_height);
			} else {
				nav.css("margin-top", 0);
			}
		});

	});
	var isHidden = false;
	function topNavScroll() {
		jQuery(window).scroll(function () {

			if (!isHidden) {
				//Animate off the screen while scrolling
				jQuery('#top-bar').animate({
					top:'-55px'
				}, 250, function () {
					//Make hidden to disable re-rendering
					jQuery('#top-bar')[0].style.visibility = "hidden";
				});
				isHidden = true;
			}
			clearTimeout(jQuery.data(this, 'scrollTimer'));
			jQuery.data(this, 'scrollTimer', setTimeout(function () {
				//Animate back on the screen when finished scrolling and make visible
				jQuery('#top-bar')[0].style.visibility = "visible";
				jQuery('#top-bar').animate({
					top:'0px'
				}, 250, function () {
				});
				isHidden = false;
			}, 500));
		});
	}


	/*Sticky box modyfication depoend on sticky box counter */

	function modifyStickyBox(){
		var sticky_post = $('.smartlib-featured-post-box');
		var sticky_count = sticky_post.length;

			if(sticky_count%2!=0 && sticky_count> 2){

				sticky_post.last().addClass('smartlib-featured-post-box-wide');

			}else if(sticky_count==1){

				sticky_post.addClass('smartlib-featured-post-box-wide');

			}

	}
})(jQuery);








