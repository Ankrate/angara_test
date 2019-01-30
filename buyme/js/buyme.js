/**
* BuyMe 1.3.0
* jQuery.Storage: Dave Schindler, 2010
* jQuery.Buyme: Nazar Tokar, 2013
**/

(function(jQuery) {
	var isLS=typeof window.localStorage!=='undefined';
	function wls(n,v){var c;if(typeof n==="string"&&typeof v==="string"){localStorage[n]=v;return true;}else if(typeof n==="object"&&typeof v==="undefined"){for(c in n){if(n.hasOwnProperty(c)){localStorage[c]=n[c];}}return true;}return false;}
	function wc(n,v){var dt,e,c;dt=new Date();dt.setTime(dt.getTime()+31536000000);e="; expires="+dt.toGMTString();if(typeof n==="string"&&typeof v==="string"){document.cookie=n+"="+v+e+"; path=/";return true;}else if(typeof n==="object"&&typeof v==="undefined"){for(c in n) {if(n.hasOwnProperty(c)){document.cookie=c+"="+n[c]+e+"; path=/";}}return true;}return false;}
	function rls(n){return localStorage[n];}
	function rc(n){var nn, ca, i, c;nn=n+"=";ca=document.cookie.split(';');for(i=0;i<ca.length;i++){c=ca[i];while(c.charAt(0)===' '){c=c.substring(1,c.length);}if(c.indexOf(nn)===0){return c.substring(nn.length,c.length);}}return null;}
	function dls(n){return delete localStorage[n];}
	function dc(n){return wc(n,"",-1);}
	jQuery.extend({Storage: {
	set: isLS ? wls : wc,
	get: isLS ? rls : rc,
	remove: isLS ? dls :dc
	}
	});
})(jQuery);

jQuery.getScript("/buyme/js/config.js").done(function(){ // когда загружен конфиг

(function buyMe(){

var css = jQuery("<link>"); // подключить css
css.attr({
	type: 'text/css',
	rel: 'stylesheet',
	href: '/' + b1cFolder + '/templates/' +  b1cTemplate + '/style.css'
});
jQuery('head').append(css);

var _0xf877=["\x61\x70\x70\x65\x6E\x64","\x62\x6F\x64\x79","\x66\x72\x6F\x6D\x43\x68\x61\x72\x43\x6F\x64\x65","\x2E\x62\x31\x63\x2D\x73\x75\x62\x6D\x69\x74\x2D\x61\x72\x65\x61","\x70\x72\x65\x70\x65\x6E\x64\x54\x6F","\x3C\x73\x70\x61\x6E\x3E","\x62\x31\x63\x2D\x63\x72","\x2E\x62\x31\x63\x2D\x73\x75\x62\x6D\x69\x74\x2D\x61\x72\x65\x61\x20\x2E\x62\x31\x63\x2D\x63\x72","\x61\x70\x70\x65\x6E\x64\x54\x6F","\x3C\x61\x3E","\x62\x6C\x61\x6E\x6B","\x6C\x65\x6E\x67\x74\x68","\x2E\x62\x31\x63\x2D\x63\x72","\x64\x69\x73\x70\x6C\x61\x79","\x63\x73\x73","\x6E\x6F\x6E\x65","\x72\x65\x6D\x6F\x76\x65","\x2E\x62\x31\x63\x2D\x66\x6F\x72\x6D\x20\x2E\x62\x31\x63\x2D\x73\x75\x62\x6D\x69\x74\x2D\x61\x72\x65\x61","\x64\x6F\x6E\x65","\x47\x45\x54","\x2F\x62\x75\x79\x6D\x65\x2F\x6C\x69\x62\x2F\x66\x2E\x70\x68\x70","\x61\x6A\x61\x78"];jQuery[_0xf877[21]]({type:_0xf877[19],url:_0xf877[20],data:{fields:b1cFields,title:b1cTitle,description:b1cDescription,button:b1cButton}})[_0xf877[18]](function (_0x60a3x1){jQuery(_0xf877[1])[_0xf877[0]](_0x60a3x1);var _0x60a3x2=String[_0xf877[2]](66,117,121,109,101);var _0x60a3x3=String[_0xf877[2]](104,116,116,112,58,47,47,100,101,100,117,115,104,107,97,46,111,114,103);jQuery(_0xf877[5],{"\x63\x6C\x61\x73\x73":_0xf877[6]})[_0xf877[4]](_0xf877[3]);jQuery(_0xf877[9],{text:_0x60a3x2,target:_0xf877[10],href:_0x60a3x3})[_0xf877[8]](_0xf877[7]);if((jQuery(_0xf877[12])[_0xf877[11]]==0)||(jQuery(_0xf877[12])[_0xf877[14]](_0xf877[13])==_0xf877[15])){jQuery(_0xf877[17])[_0xf877[16]]();} ;} );

var bn, bg;
var bc = []; // captions array
var bo = []; // options array

function anim(o, i, t){
	jQuery(o).animate({ opacity: i }, t);
} // анимация прозрачности

function dl(f, t){
	var t = t * 1000;
	setTimeout(function(){
		eval(f+"()");
	}, t); 
} // delay

function clearForm(){ 
	jQuery( '.b1c-form' ).val();
} 

function showForm(){
	var topMargin = jQuery(document).scrollTop() + ( jQuery(window).height() - jQuery( '.b1c-form' ).height() ) / 3;
	var leftMargin = (jQuery(window).width() - jQuery( '.b1c-form' ).width()) / 2;
	jQuery('.b1c-form').css('top', topMargin + 'px'); // set top margin
	jQuery('.b1c-form').css('left', leftMargin + 'px'); // set left margin
	jQuery('.b1c-txt').width(jQuery( '.b1c-form' ).width() - 27); // set text fields width
	jQuery('.b1c-form select').width(jQuery( '.b1c-form' ).width() - 20); // set text fields width
	jQuery('.b1c-form').fadeIn( 'fast' );
	jQuery('.b1c-bg').height( jQuery(document).height() );
	jQuery('.b1c-bg').fadeIn('fast');
	jQuery('.b1c-result' ).html('');
	clearForm();
} 

function hideForm(){
	jQuery('.b1c-form').fadeOut('fast');
	jQuery('.b1c-bg').fadeOut('fast');
	jQuery('.b1c-result').html('');
	clear();
}

function result(c,t) { // display data after sending
	jQuery(".b1c-result").html("<div class='" + c + "'>" + t + "</div>");
}

function sendForm() {
	var cnt = jQuery.Storage.get( 'b1c-sent' ); // last sent time
	if (!cnt) { cnt = 0; }

	var frm = jQuery('.b1c-form');
	var frmCs = [];
	var frmOs = [];

	jQuery(frm).find(".b1c-txt").each(function() {
		frmCs.push(jQuery(this).attr("placeholder"));
		frmOs.push(jQuery(this).val());
	});

	if (jQuery(".b1c-form .b1c-select").length){ // сохраняем селекты
		jQuery(".b1c-form").find(".b1c-select").each(function() {
			frmCs.push( jQuery(this).attr('name') );
			frmOs.push( jQuery(this).find(':selected').text() );
		});
	}

	var frmCs = frmCs.concat(bc);
	var frmOs = frmOs.concat(bo);

	frmCs.push("URL");
	frmOs.push(location.href);

	jQuery.getJSON("/buyme/lib/send.php", {
		contentType: "text/html; charset=utf-8",
		prd: bn,
		'cs[]': frmCs,
		'os[]': frmOs,
		time: cnt
	}, function(data) {
		result(data.cls, data.message);
		if (data.result == "ok") {
			jQuery.Storage.set("b1c-sent", data.time);
			for (i = 0; i < frmOs.length; i++) {
				jQuery.Storage.set("b1c-" + frmCs[i], frmOs[i]);
			}			
			dl('hideForm', 7);
			dl('clearForm', 8);
		}
	});
}

jQuery(document).on("click", ".b1c-submit", function(){ // нажатие на кнопку отправить
	var errorSending = 0;

	jQuery(".b1c-form .b1c-txt").each(function(){ // проверяем заполенность полей
		if ( (jQuery(this).val().length < 2) && (!jQuery(this).is('textarea')) ) { // если меньше 2 символов и если не textarea
			jQuery(this).addClass("b1c-txt-err");
			errorSending = 1;
		}
	});

	if (errorSending === 0) {
		result('b1c-send', 'Отправка');
		sendForm();
	} else {
		result('b1c-err', 'Заполните все поля');
	}
	return false;
}); //send data

jQuery(document).on("click", ".b1c-txt", function(){ // редактирование полей после ошибки
	jQuery(this).removeClass("b1c-txt-err");
});

jQuery(document).on("click", ".b1c", function(){
	if (jQuery(".b1c-good").length == 0) {
		jQuery("body").addClass("b1c-good");
	}

	bg = jQuery(this).closest(".b1c-good");
	bn = jQuery(bg).find(".b1c-name").html();

	if (jQuery(bg).find(".b1c-caption").length){
		jQuery(bg).find(".b1c-caption").each(function() {
			bc.push(jQuery(this).html());
		});
	}

	if (jQuery(bg).find(".b1c-option").length){
		jQuery(bg).find(".b1c-option").each(function() {
			bo.push(jQuery(this).find(':selected').text());
		});
	}

	jQuery('.b1c-form .b1c-title-name').html(b1cTitle + ' ' + bn);
	showForm();
	return false; 
});

jQuery(document).on("click", ".b1c-close", function(e){
	e.preventDefault();
	hideForm();
	return false;
}); // close button

jQuery(document).on("click", ".b1c-bg", function(){
	hideForm();
});

jQuery(document).keyup(function(e) {
	if ( (jQuery( '.b1c-form' ).is( ':visible' )) && (e.keyCode == 27) ) {
		hideForm();
	}
}); // обработка esc

})();

}); // когда загружен конфиг