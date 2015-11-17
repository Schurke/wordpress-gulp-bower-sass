// ==== CORE ==== //

// A simple wrapper for all your custom jQuery; everything in this file will be run on every page
;(function($){
	$(function(){
		// Insert one-off jQuery code here!
		

		// carousel initializer
		if ("N_Carousel" in window){
			N_Carousel = new N_Carousel();
		}
		
		// initialise video players -- TODO this has to be revised for multiple players on page by parcelling it out into a jquery plugin
		if ("N_VideoPlayer" in window){
			N_VideoPlayer = new N_VideoPlayer(".player-video");
		}
		
		// use jquery to add wow attributes to elements
		/*
		var selector = "";
		selector = '.carousel-caption, .logo';
		$(selector).addClass('wow fadeInUp');
		$(selector).attr('data-wow-offset-percent','10');
		*/
		
		// wow js implementation
		if ("N_Wow" in window){
			N_Wow = new N_Wow();
		}

		// bootstrap initializers
		$('[data-toggle="tooltip"]').tooltip({html: true});


	});
}(jQuery));
