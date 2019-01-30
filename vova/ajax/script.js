window.onload = function(){
	
	document.querySelector('#send-request').onclick = function(){
		ajaxGet('ajax.php', function(data){
			console.log(data);
		});
		
		ajaxGet('ajax.php?one=1&two=2', function(data){
			document.querySelector('#result').innerHTML = data;
		});
	};
	
	
	
	function ajaxGet(url, callback){
		
		var f = callback || function(data){};
		var request = new XMLHttpRequest();
		
		request.onreadystatechange = function(){
			if(request.readyState == 4 && request.status == 200){
				f(request.responseText);
				document.querySelector('#result').innerHTML = request.responseText;
			}
		};
		
		
		request.open('GET', url);
		request.send();
	}
	
	
};
