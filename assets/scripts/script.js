$(document).ready(function(){
	//--Set aside and section on top style
	setResizePage();

	$(window).on('resize', function(e){
		$('.aside').show();
		$('.aside-resize').hide();
		setResizePage();
	});

	function setResizePage(){
		var headerHeight = $('.header').height();
		var contentHeight = $(window).height() - headerHeight;
		var asideWidth = $('.aside').width();
		var asideResizeHeight = $('.aside-resize').height();
		
		$('.aside, .section').css({ 'top': headerHeight });
		$('.aside').css({ 'height': contentHeight });
		$('.section').css({ 'left': (asideWidth + 29.5) });
		
		if($(window).width() < 992){
			$('.aside').hide();
			$('.aside-resize').show();

			$('.aside-resize').css({ 'top': headerHeight });
			$('.section').css({ 'left': '0', 'top': (headerHeight + asideResizeHeight) });
		}
	}

	//--Event of accordian on click
	$(document).on('click', '#accordian h3', function(e){
	    if(!$(this).next().is(':visible'))
	    	$(this).next().slideDown();
	    else
	    	$(this).next().slideUp();
	});
});