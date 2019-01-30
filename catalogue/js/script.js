$(document).ready(function(){
	
	$('#A').mapster({
        fillOpacity: 0,
        fillColor: 'FF0000',

        stroke: true,
        strokeOpacity: 0.5,
        strokeColor: '0000FF',
        strokeWidth: 2,
        clickNavigate: true 
        
		
        
      }).parent().css({"margin":"0 auto"});
    
    $('area').mapster('set',true);
		
});