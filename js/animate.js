// Debounce do Lodash

debounce = function(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

(function(){

	var target = $('.animate');
	var offset = $(window).height() * 3.5/4;
	var animationClass = "animate__animated " + $(target).attr("data-animate");

	function animeScroll() {	
		
		//var documentTop = $(document).scrollTop();

		target.each(function(){
			var itemTop = $(this).offset().top;
			var documentTop = $(document).scrollTop();

			var animationClass = "animate__animated " + $(this).attr("data-animate");
			var delay = $(this).attr("delay-animate");	

			if (documentTop > itemTop - offset) {
					
				    $(this).delay(delay).queue(function(){
				    	$(this).addClass(animationClass);
				    });
				
			} else {
				//$(this).removeClass(animationClass);
			}
		});
	}

	animeScroll();

	$(document).scroll(debounce(function(){
		animeScroll();
	}, 1));
})();