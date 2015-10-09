/**
* N_VideoPlayer is a controller that controls an html5 video instance
* TODO: rework this to work with multiple video instances on one page
* @author: Craig Harwood
* @project: 
*/

function N_VideoPlayer(selector){
	// ------------------------------------------------
	// DEFINE PROPERTIES
	// ------------------------------------------------
	var self = this;
	var $ = jQuery;
	this.isPlayingBln = false;
	this.hoverBln = true;
	this.readyBln = false;
	// ------------------------------------------------
	// INITIALIZATION
	// ------------------------------------------------

	/**
	* Pseudo Constructor, calls additional initialization methods.
	*/
	this.init = function(){
		// console.log("N_VideoPlayer");
		if ($(selector).length>0){
			this.setupProps();
			this.setupListeners();
			this.generate();
		}
	};
	
	
	/**
	* Sets Secondary / Advanced Properties
	*/
	this.setupProps = function(){
		// console.log("N_VideoPlayer.setupProps");
	};

	/**
	* Adds data-based abstract listeners
	*/
	this.setupListeners = function(){
		// register listeners
		var video = $(selector+' .video-item').get(0);
		video.addEventListener('ended', function(e){
			self.closeVideo();
			self.updateUI();
		}, false);
		video.addEventListener('pause', function(e) {
			self.isPlayingBln=false; 
			self.updateUI();
		}, false);
		video.addEventListener('play', function(e) {
			console.log("playing");
			self.isPlayingBln=true; 
			self.updateUI();
		}, false);
		video.addEventListener('canplay', function(e) {
			self.readyBln=true; 
			self.updateUI();
		}, false);
		video.addEventListener('waiting', function(e) {
			self.readyBln=false; 
			self.updateUI();
		}, false);
		// close support
		$(selector).mouseenter(function(){
			self.hoverBln = true;
			self.updateUI();
		});
		$(selector).mouseleave(function(){
			self.hoverBln = false;
			self.updateUI();
		});

		$(selector+" .play-pause-btn").click(function(){ self.playPauseClicked(); });
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
		// console.log("N_VideoPlayer.generate");
		this.updateUI();
	};


	// ------------------------------------------------
	// DATA
	// ------------------------------------------------

	/**
	* Retrieves data
	*/
	this.updateUI = function(){
		// console.log("N_VideoPlayer.updateUI");
	
		this.showPlayingControls(this.isPlayingBln);
		this.showBuffering(!this.readyBln);
		this.showControls(this.hoverBln);
	};

	this.showControls = function(bln){
		if (bln==true){
			$(selector+" .play-pause-btn").addClass('show');
			$(selector+" .close-btn").addClass('show');
		} else {
			$(selector+" .play-pause-btn").removeClass('show');
			$(selector+" .close-btn").removeClass('show');
		}
	};
	this.showBuffering = function(bln){
		if (bln==true){
			$(selector+" .buffering").addClass('show');
		} else {
			$(selector+" .buffering").removeClass('show');
		}
	};
	this.showPlayingControls = function(bln){
		if (bln==true){
			$(selector+" .play-pause-btn").addClass('playing');
		} else {
			$(selector+" .play-pause-btn").removeClass('playing');
		}
	};

	// ------------------------------------------------
	// EVENT HANDLERS
	// ------------------------------------------------



	/**
	* Handles user interaction
	*/
	this.buttonReleased = function(){
		// console.log("N_VideoPlayer.buttonReleased");
	};


	/**
	 * Play video clicked - show and start
	 * @param obj {Object} All parameters are properties of this object.
	 */
	this.playVideoClicked = function(event) {
		console.log("N_VideoPlayer.playVideoClicked");
		/*
		if (K_Methods.isMobile.any()){
			var video = $('#home-video-item source').get(0);
			var src = $(video).attr('src');
			//console.log(src);
			
			window.open(src,'_blank');
		} else {
			this.playVideo();
		}
		*/
		this.playVideo();
	};
	
	/**
	 * Plays the video
	 * @param obj {Object} All parameters are properties of this object.
	 */
	this.playVideo = function() {
		console.log("N_VideoPlayer.playVideo");
		
		this.showVideoBln = true;
		var video = $(selector+' .video-item').get(0);
		video.load();
		video.play();
		
	};


	

	/**
	 * Close video enacted
	 * @param obj {Object} All parameters are properties of this object.
	 */
	this.closeVideoClicked = function() {
		console.log("N_VideoPlayer.closeVideoClicked");
		this.closeVideo();
	};
	
	/**
	 * Closes the video
	 * @param obj {Object} All parameters are properties of this object.
	 */
	this.closeVideo = function() {
		console.log("N_VideoPlayer.closeVideo");
		var video = $(selector+' .video-item').get(0);
		video.pause();
		
		
		
	};
	

	/**
	 * description
	 * @param obj {Object} All parameters are properties of this object.
	 */
	this.playPauseClicked = function() {
		console.log("N_VideoPlayer.playPauseClicked");
		var video = $(selector+' .video-item').get(0);
		if (this.isPlayingBln==true){
			video.pause();
		} else {
			video.play();
		}
	};



	// ------------------------------------------------
	// DESTRUCTION
	// ------------------------------------------------

	/**
	* Performs additional destruction tasks
	*/
	this.destroy = function(){
		// console.log("N_VideoPlayer.destroy")
		this.removeListeners();
		
	};
	
	// Pseudo Constructor call
	this.init();
	
	return this;
}
