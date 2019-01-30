function initialize() {
		var myLatlng = new google.maps.LatLng(55.891520, 37.402525);
		var mapOptions = {
			zoom : 16,
			center : myLatlng
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		var marker = new google.maps.Marker({
			position : myLatlng,
			map : map,
			title : 'Компания АНГАРА'
		});
	}


	google.maps.event.addDomListener(window, 'load', initialize);