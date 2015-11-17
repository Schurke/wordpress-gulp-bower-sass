/**
* N_Wow is a micro-class that implements wow using specific parameters
* @author: Craig Harwood
* @project: ProjectName
*/
function N_Wow(){
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
		// console.log("N_Wow");
		if ("WOW" in window){
			this.setupProps();
			this.setupListeners();
			this.generate();
		} else {
			console.log("N_Wow :: WOW not available.");
		}
	};
	
	
	/**
	* Sets Secondary / Advanced Properties
	*/
	this.setupProps = function(){
		// console.log("N_Wow.setupProps");
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
		// console.log("N_Wow.generate");

	
		// call update function
		this.updateWowOffsets();
		// initialise wow js
		var wow = new WOW({
			boxClass: 'wow',			// default
			animateClass: 'animated',	// default
			offset: 0,					// default
			mobile: true,				// default
			live: true					// default
		});
		wow.init();
		// TODO may need to listen for window resize and call wow.sync() 
	};

	this.updateWowOffsets = function(){
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
	};
	// ------------------------------------------------
	// DATA
	// ------------------------------------------------

	/**
	* Retrieves data
	*/
	this.update = function(){
		// console.log("N_Wow.update");
	};


	// ------------------------------------------------
	// EVENT HANDLERS
	// ------------------------------------------------

	/**
	* Handles user interaction
	*/
	this.buttonReleased = function(){
		// console.log("N_Wow.buttonReleased");
	};


	// ------------------------------------------------
	// DESTRUCTION
	// ------------------------------------------------

	/**
	* Performs additional destruction tasks
	*/
	this.destroy = function(){
		// console.log("N_Wow.destroy")
		this.removeListeners();
		
	};
	
	// Pseudo Constructor call
	this.init();
	
	return this;
}
