// ==== CORE ==== //

// A simple wrapper for all your custom jQuery; everything in this file will be run on every page
;(function($){
	$(function(){
	// Insert jQuery code here!
	var i=0;
	// carousel init
	$('.carousel-zoom').addClass('init');
	window.setTimeout(function(){
		$('.carousel-zoom').removeClass('init');
	}, 10);

	// apply data classes on the slightest delay so that css3 animations trigger
	window.setTimeout(function(){
		$('[data-class="active"]').each(function(index){
			$(this).addClass($(this).attr('data-class'));
		});
	}, 10);
	
	// initialise video players -- note this has to be revised for multiple players
	if ("N_VideoPlayer" in window) N_VideoPlayer = new N_VideoPlayer(".player-video");
	
	// fix the header nav states
	$('#voidx-header-nav .menu-item a').each(function(){
		// do i have a hash? if so, remove my active class TODO something more sophisticated that handles hashes better.
		if ($(this).attr('href').indexOf('#')>-1 ){
			$(this).parent().removeClass('active');
		}
	});

	// add button styles to the un-sstylable
	$('input[type="submit"]').addClass('btn-primary');
	$('input').addClass('form-control');

	// decorate some wows for home and global
	var selector = "";
	selector = '.carousel-caption, .logo';
	$(selector).addClass('wow fadeInUp');
	$(selector).attr('data-wow-offset-percent','10');
	// parallax sections
	selector = '.page-template-parallax .fluid-width-image h1';
	$(selector).addClass('wow fadeInUp');
	$(selector).attr('data-wow-offset-percent','10');
	// do the nested units slightly differently
	selector = ".page-template-parallax .image-title-body";
	$(selector).addClass('wow fadeInUp');
	$(selector).attr('data-wow-offset-percent','10');
	i=0;
	$(selector).each(function(){
		$(this).attr('data-wow-delay', (0.25*i)+'s');
		i++;
	});
	
	
	$('.blog .type-post .entry-content p:first-of-type, .single-post .type-post .entry-content p:first-of-type').each(function(){
		// rework paragraph
		var text = $(this).html();
		// console.log(text);
		text = '<span class="first-char">'+text.substr(0,1)+'</span>' + text.substr(1);
		$(this).html(text);
	});

	// wow js
	// TODO class this out

	function updateWowOffsets(){
		// dyanmically update the data-wow-offset value from percentage
		$('.wow').each(function(index){
			// get value of data-wow-offset-percent
			var percent = $(this).attr('data-wow-offset-percent');
			if (percent){
				// get height of browser
				var browserHeight = $(window).height();
				// update value
				var offset = (Number(percent)/100) * browserHeight;
				$(this).attr('data-wow-offset', offset);
			}
		});
	}
	
	// call update function
	updateWowOffsets();
	// initialise wow js
	var wow = new WOW({
		boxClass: 'wow',			// default
		animateClass: 'animated',	// default
		offset: 0,					// default
		mobile: true,				// default
		live: true					// default
	});
	wow.init();
	// may need to listen for window resize and call wow.sync() 
	// may need to update offsets based on percentage of browser height 

	// bootstrap initializers
	$('[data-toggle="tooltip"]').tooltip({html: true});


	});
}(jQuery));
