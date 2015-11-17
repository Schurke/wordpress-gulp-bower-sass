/**
* N_Carousel is a controller that configures additional carousel behaviours
* @author: Craig Harwood
* @project: ProjectName
*/
function N_Carousel(){
	// ------------------------------------------------
	// DEFINE PROPERTIES
	// ------------------------------------------------
	var self = this;
	var $ = jQuery;
	

	// ------------------------------------------------
	// INITIALIZATION
	// ------------------------------------------------

	/**
	* Pseudo Constructor, calls additional initialization methods.
	*/
	this.init = function(){
		// console.log("N_Carousel");
		this.setupProps();
		this.setupListeners();
		this.generate();
	};
	
	
	/**
	* Sets Secondary / Advanced Properties
	*/
	this.setupProps = function(){
		// console.log("N_Carousel.setupProps");
	};

	/**
	* Adds data-based abstract listeners
	*/
	this.setupListeners = function(){
		// register listeners
	};
		
	/**
	* Removes data-based abstract listeners
	*/
	this.removeListeners = function(){
		// de-register listeners
	};
	
	
	// ------------------------------------------------
	// GENERATION
	// ------------------------------------------------

	/**
	* Performs initial DOM manipulation tasks
	*/
	this.generate = function(){
		// console.log("N_Carousel.generate");

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


	};


	// ------------------------------------------------
	// DATA
	// ------------------------------------------------

	/**
	* Retrieves data
	*/
	this.update = function(){
		// console.log("N_Carousel.update");
	};


	// ------------------------------------------------
	// EVENT HANDLERS
	// ------------------------------------------------

	/**
	* Handles user interaction
	*/
	this.buttonReleased = function(){
		// console.log("N_Carousel.buttonReleased");
	};


	// ------------------------------------------------
	// DESTRUCTION
	// ------------------------------------------------

	/**
	* Performs additional destruction tasks
	*/
	this.destroy = function(){
		// console.log("N_Carousel.destroy")
		this.removeListeners();
		
	};
	
	// Pseudo Constructor call
	this.init();
	
	return this;
}
