var x=y=0;

var data ={

add: '',
key:'',
coords:'',
title:''
}
var Items;

//удалить элемент с карты
var delItem = function (data_add){
$('li .del-item[add="'+data_add+'"]').parent("li").detach();
$('area[add="'+data_add+'"]').detach();
loadcart();
}

//получить значение add у элемента с key=
var keyToADD = function(key){
return $( "area[data-mapster-key="+key+"]").attr('add');
}

function loadcart(){
//карта
function select_pnc()
{

$('area').each(function(idx,val) {
$(val).mapster('select');
});

}

$(function() {
var img = $('#mymap');
img.mapster({
fillOpacity: 0.4,
fillColor: "d42e16",
stroke: true,
strokeColor: "0000FF",
strokeOpacity: 0.8,
strokeWidth: 4,
onClick: function(e){
delItem(keyToADD(e.key));
return false;
}

});

select_pnc();
});
}

loadcart();




//добавить блокна карту
$('#add-map').click(function(){
var itemAdd;
var x1=x+43;
var y1=y+15;

itemAdd = $("#navmap area").length;

$("#navmap").append( '<area shape="rect" coords="'+x+','+y+','+x1+','+y1+'" href="#" add="'+itemAdd+'">' );

loadcart(); //отрисуем
//получим номер
itemAdd = $( "area" ).last().attr('data-mapster-key');

$("#item-add").append( '<li>title="ДОМКРАТ " coords="'+x+','+y+','+x1+','+y1+'" <span class="del-item" add="'+itemAdd+'">Удалить</span></li>' );


data.coords=x+','+y+','+x1+','+y1;
data.add=itemAdd;
data.key='';
data.title='';

//console.log(data);
});

//клик по удалитьиз списка
$('body').on('click', '.del-item', function(){
var data_add = $(this).attr('add');
delItem(data_add);
});