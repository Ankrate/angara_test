$(document).ready(function(){

		

		var pathname = window.location.pathname,
			page = pathname.split(/[/ ]+/).pop(),
			menuItems = $('#wrapper_apple a');
		menuItems.each(function(){
			var mi = $(this),
				miHrefs = mi.attr("href"),
				miParents = mi.parents('li');
			if(page == miHrefs) {
				miParents.addClass("active_apple").siblings().removeClass('activ_apple');
			}
		});

			// Hide form
			function hideMyForm () {
			$('#leftHidd').slideToggle(500);
			}
			
			$('#leftHidd').hide();
			$('#myForm').click(function(){
				hideMyForm();
			});
			
			//Hide add block
			
			function hideMyAdds () {
			$('#hiddenAdds').delay('1000').slideUp(1000);
			}
			
			hideMyAdds();
			
			//Hide right side			
			$('#rightMenu').slideToggle(2000);
			
			
			//Here is the scroll gallery on the landing
			
			
			$(".my_carusel img").hide();
			$(".my_carusel img").fadeIn(3000);
			
			//
			
			
					
			
		
}); //End of Redy

if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}

$('#ang-header-top').on('hidden.bs.collapse', function () {
     $('#menu2Div').hide();
});

