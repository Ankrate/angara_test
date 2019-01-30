window.onload = function(){
	
	
	
	var items = document.querySelectorAll('.items .item');
	
	for(var i = 0; i < items.length; i++){
		items[i].onclick = function(){
			fade(this,1000,function(){
				this.style.display = 'none';
			});
		};
	}

};
function mtRand(min,max){
	return Math.floor(Math.random() * (max-min+1));
}

//Function fade
function fade(elem,t,f){
	var fps = 50;
	var time = t || 500;
	var steps = time / fps;
	var op = 1;
	var d0 = op / steps;
	
	var callback = f || function(){};
	
	var timer = setInterval(function(){
		op -= d0;
		elem.style.opacity = op;
		steps--;
		
		if (steps === 0){
			clearInterval(timer);
			callback.call(elem);
		}
	}, (1000 / fps));
}
