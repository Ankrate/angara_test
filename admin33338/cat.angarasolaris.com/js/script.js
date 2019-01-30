$(document).ready(function(){
	var ArrayItems = Array(); //масив добавленых объектов
	var ArrayEditItems = Array(); //масив редактирования
	var Map = '#navmap';
	var mymap = '#mymap';
	var fomes = '#fomes';
	var BDinfo; //данные из бд по непроверенной странице

	Start();
	// ajax запроск к бд
	 function Bd(data){
		var rez = $.ajax({
			url: "php/index.php",
			type: "POST",
			dataType: "json",
			async: false,
			data: data
		}).responseText;

		console.log($.parseJSON(rez));

		return rez;

	};

	//BDinfo =$.parseJSON( Bd({info:true})); //получить не проверенные даные из бд
	//console.log(BDinfo);
	//добавление элементов из бд на карту
	function addItemsBD(){
		var items = BDinfo['1'];
		//console.log(items['0'].id_h3);

		$('#check').attr('add',items['0'].id_h3); //добавить атрибут на кнопку проверки
		//console.log(items['0']);
		$('#check_img').attr('img',items['0'].img); //добавить атрибут на кнопку img

		$(mymap).attr("src",'../../catalogue/p1/'+items['0'].img.substring(1));
		$(Map).text('');
		for(var it in  items){

			$(Map).append( '<area edit="'+it+'" data-key="'+items[it].keyd+'"  title="'+items[it].title+'" shape="rect" coords="'+items[it].coords+'" href="#" ">' );


		}
		loadcart();
	}

	//addItemsBD();



	//редактирование
	//добавить блок для редактирования
	var addEdirDlok = function(editkey){
		Start();
		editkey= editkey.toString();

		$('#fomes').html('');

		var data_h3 = BDinfo['0'];
		var items = BDinfo['1'];
		var itemsh5 = BDinfo['2'];


		$(fomes).append('<div class="formEdit" edit="'+editkey+'" action=""></div>');
		$(fomes + ' .formEdit[edit='+editkey+']').append('<label for="">Редактирование на карте: '+editkey+'</label>');
		$(fomes + ' .formEdit[edit='+editkey+']').append('<label for="">id_h3 - таблица h4<input type="text" name="id_h3_h4" class="id_h3_h4" placeholder="Пусто" disabled value="'+data_h3['id']+'"></label>');
		$(fomes + ' .formEdit[edit='+editkey+']').append('<label for="">img - таблица h4<input type="text" name="img_h4" class="img_h4" placeholder="Пусто" disabled value="'+items[0].img+'"></label>');
		$(fomes + ' .formEdit[edit='+editkey+']').append('<label for="">keyd - таблица h4<input type="text" name="keyd_h4" class="keyd_h4" placeholder="Пусто" value="'+items[editkey].keyd+'"></label>');
		$(fomes + ' .formEdit[edit='+editkey+']').append('<label for="">coords - таблица h4<input type="text" name="coords_h4" class="coords_h4" placeholder="Пусто" disabled value="'+items[editkey].coords+'"></label>');
		$(fomes + ' .formEdit[edit='+editkey+']').append('<label for="">title - таблица h4<input type="text" name="title_h4" class="title_h4" placeholder="Пусто" value="'+items[editkey].title+'"></label>');
		$(fomes + ' .formEdit[edit='+editkey+']').append('<label for="">title2 - таблица h4<input type="text" name="title2_h4" class="title2_h4" placeholder="Пусто" value="'+items[editkey].title2+'"></label>');
		$(fomes + ' .formEdit[edit='+editkey+']').append('<button id="AddH5" AddH5="'+editkey+'">Добавить новый>>добавить</button>');
		//console.log(items[editkey])


		for(var i in itemsh5[editkey]){
			$(fomes + ' .formEdit[edit='+editkey+']').append('<form class="edith5" edit="'+editkey+'" edith5="'+i+'">'+i+'=========================================</form>');
			$(fomes + ' .edith5[edith5='+i+']').append('<label for="">numer - таблица h5<input type="text" name="numer" class="numer_h5" placeholder="Пусто-здесь" value="'+itemsh5[editkey][i].numer+'"></label>');
			$(fomes + ' .edith5[edith5='+i+']').append('<label for="">count - таблица h5<input type="text" name="count" class="count_h5" placeholder="Пусто" value="'+itemsh5[editkey][i].count+'"></label>');
			$(fomes + ' .edith5[edith5='+i+']').append('<label for="">period - таблица h5<input type="text" name="period" class="period_h5" placeholder="Пусто" value="'+itemsh5[editkey][i].period+'"></label>');
			$(fomes + ' .edith5[edith5='+i+']').append('<label for="">description  - таблица h5<textarea rows="10" cols="45" name="description" class="description_h5" placeholder="Пусто" >'+itemsh5[editkey][i].description+'</textarea></label>');
			$(fomes + ' .edith5[edith5='+i+']').append('<button id="deledit" edit="'+editkey+'" edith5="'+i+'"><блок>>Удалить</button>');
			$(fomes + ' .edith5[edith5='+i+']').append('<label for=""><input type="submit" edith5="'+i+'" value="Изменить запись в бд"></label>');

		}

	}



	function SaveEdit(edit,edith5,arrFormData){

		//обновляем данные в массиве

		//таблица h4
		BDinfo['1'][edit]['keyd'] = $(".keyd_h4").val();
		BDinfo['1'][edit]['title'] = $(".title_h4").val();
		BDinfo['1'][edit]['title2'] = $(".title2_h4").val();

		//таблица h5
		for(var it in arrFormData){
			BDinfo['2'][edit][edith5][arrFormData[it].name] = arrFormData[it].value;
		}

		var h4data = BDinfo['1'][edit];
		var h5data = BDinfo['2'][edit][edith5];

		var h4sel='';
		for(it in h4data){
			h4sel +='&'+it+'='+h4data[it];

		}
		var h5sel='';
		for(it in h5data){
			h5sel +='&'+it+'='+h5data[it];

		}

		var jsonData = 'update=true'+h4sel+h5sel;

		var BDAdd = $.parseJSON( Bd(jsonData));// записать строку в бд

		var keyd = BDinfo['1'][edit]['keyd'];
		if(BDAdd[1]!=true){$('#info').text('Запись НЕ обновлена keyd = '+keyd);}else{
			$('#info').text('Запись обновлена keyd = '+keyd);
		}

		//console.log(BDAdd);
		//console.log(jsonData);
		//console.log(arrFormData);


	}






	//добавить блок в h5
	function AddH5(editkey){
		var data_h3 = BDinfo['0'];
		var items = BDinfo['1'];
		var itemsh5 = BDinfo['2'];

		var id_h4 = items[editkey]['id'];

		console.log(id_h4);
		var jsonData = 'addh5=true&id_h4='+id_h4;

		var BDAdd = $.parseJSON( Bd(jsonData));// записать строку в бд

		//console.log(BDAdd);

		Start();
		addEdirDlok(editkey);
	}

	//удалить блок из h5
	function DelH5(edit,edith5){
		var data_h3 = BDinfo['0'];
		var items = BDinfo['1'];
		var itemsh5 = BDinfo['2'];

		var id_h5 = itemsh5[edit][edith5]['id'];


		var jsonData = 'delh5=true&id_h5='+id_h5;

		var BDAdd = $.parseJSON( Bd(jsonData));// записать строку в бд

		//console.log(jsonData);

		Start();
		addEdirDlok(edit);
	}

	//добавить форму
	var AddForm = function(add){
	//чистим редактирование
	$('.formEdit').detach();


		var add = this.itemAdd;
		var items_h3 = BDinfo['0'];
		var items_h4 = BDinfo['1'];


		this.id_h3_h4 = items_h3.id;
		this.img_h4 = items_h4[0].img;


		$(fomes).append('<form class="formCheck" add="'+add+'" action=""></form>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">На карте добавлен: '+add+'</label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">id_h3 - таблица h4<input type="text" name="id_h3_h4" class="id_h3_h4" placeholder="Пусто" disabled value="'+this.id_h3_h4+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">img - таблица h4<input type="text" name="img_h4" class="img_h4" placeholder="Пусто" disabled value="'+this.img_h4+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">keyd - таблица h4<input type="text" name="keyd_h4" class="keyd_h4" placeholder="Пусто" value="'+this.keyd_h4+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">coords - таблица h4<input type="text" name="coords_h4" class="coords_h4" placeholder="Пусто" disabled value="'+this.coords_h4+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">title - таблица h4<input type="text" name="title_h4" class="title_h4" placeholder="Пусто" value="'+this.title_h4+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">title2 - таблица h4<input type="text" name="title2_h4" class="title2_h4" placeholder="Пусто" value="'+this.title2_h4+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">numer - таблица h5<input type="text" name="numer_h5" class="numer_h5" placeholder="Пусто" value="'+this.numer_h5+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">count - таблица h5<input type="text" name="count_h5" class="count_h5" placeholder="Пусто" value="'+this.count_h5+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">period - таблица h5<input type="text" name="period_h5" class="period_h5" placeholder="Пусто" value="'+this.period_h5+'"></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for="">description  - таблица h5<textarea rows="10" cols="45" name="description_h5" class="description_h5" placeholder="Пусто" >'+this.description_h5+'</textarea></label>');
		$(fomes + ' .formCheck[add='+add+']').append('<label for=""><input type="submit" value="Добавить запись в бд"></label>');



	}

	//удалить форму
	var DelForm = function(){
		var add = this.itemAdd;
		$(fomes+' .formCheck[add="'+add+'"]').detach();

	}






	// call  к объекту с id из масссива
	var ObIsArr = function(idadd,call){
		for(var i in ArrayItems){
			if(ArrayItems[i].itemAdd==idadd){
				call( ArrayItems[i]);
			}
		}
	}

	//добавить элемент на карту
	var AddMapitem = function(){
		this.itemAdd = selectBlock.itemAdd;
		$(Map).append( '<area shape="rect" coords="'+this.coords_h4+'" href="#" add="'+this.itemAdd+'">' );

		return true;
	};

	//удалить элемент с карты
	var DelMapItem = function(){
		$(Map + ' area[add="'+this.itemAdd+'"]').detach();
		return true;
	};


	//сохранить даные
	var SaveForm = function(formData,jsonData){

		for(var it in formData){
			this[formData[it].name] = formData[it].value
		}

		jsonData= jsonData+'&id_h3_h4='+this.id_h3_h4+'&img_h4='+this.img_h4+'&coords_h4='+this.coords_h4+'&add=true';

		var BDAdd = Bd(jsonData);// записать строку в бд

		//console.log('-----------');
		//console.log(jsonData);
		//console.log('-----------');

	};



	//добавленый объект
	var Itemes = {
		itemAdd: 0,
		id_h3_h4: '',
		img_h4:'',
		keyd_h4:'',
		coords_h4:'',
		title_h4:'',
		title2_h4:'',
		numer_h5:'',
		count_h5:'',
		period_h5:'',
		description_h5:'',
		href: "#",
		add: AddMapitem,
		del: DelMapItem,
		addForm: AddForm,
		delForm: DelForm,
		saveForm: SaveForm,
	};

	//прамоугольник добавления
	var Resize = function(){

		$(this.id).width(this.width+'px');
		$(this.id).height(this.height+'px');

	}

	var selectBlock = {
		id: "#item .item",
		save:true,
		x:12,
		y:31,
		width: 40,
		height: 11,
		itemAdd:-1,
		resize: Resize
	}


	//перемещение selectBlock
	$("#item").draggable({ drag:function(event, ui){
		selectBlock.x = ui.position.left;
		selectBlock.y = ui.position.top;

		//console.log(selectBlock);
	}});

	//меняем размер блока
	$("#item .rez").draggable({ drag:function(event, ui){
		selectBlock.width = ui.position.left>0?ui.position.left:0;
		selectBlock.height = ui.position.top>0?ui.position.top:0;

		selectBlock.resize();
	}});

		//тоскаем карту
	$("#blockMap").draggable();

	//добавить блок на карту + форма
	$('#add-map').click(function(){
		selectBlock.save=false;


		var x = selectBlock.x+2;
		var x1 = x + selectBlock.width+4;

		var y = selectBlock.y+2;
		var y1 = selectBlock.y + selectBlock.height+6;

		var item = Object.create(Itemes);

		item.itemAdd = selectBlock.itemAdd++;
		item.coords_h4 = x+','+y+','+x1+','+y1;
		item.add();
		item.addForm();

		ArrayItems.push(item);

		loadcart();

		//console.log(selectBlock);
		//console.log(ArrayItems);


	});





	//удалить объект карта форма
	var delItem = function (data_add){
		//удалить с карты
		$('area[add="'+data_add+'"]').detach();
		//удалить форму
		ObIsArr(data_add, function(e){e.delForm();})
		//удалить объект
		ObIsArr(data_add, function(e){delete(ArrayItems[e.itemAdd]);})


		loadcart();
	}

	//получить значение add у элемента с key=
	var keyToADD = function(key){
		return $( "area[data-mapster-key="+key+"]").attr('add');
	}

	var Editkey = function(key){
		return $( "area[data-mapster-key="+key+"]").attr('edit');
	}

	//плагин карты
	function loadcart(){
		//карта
		function select_pnc()
		{

			$('area').each(function(idx,val) {
				$(val).mapster('select');
			});

		}


		var img = $('#mymap');
		img.mapster({
			fillOpacity: 0.4,
			fillColor: "d42e16",
			stroke: true,
			strokeColor: "0000FF",
			strokeOpacity: 0.8,
			strokeWidth: 4,
			onClick: function(e){
				var i = keyToADD(e.key);
				if(i){delItem(i);}//удалить добавленый


				var editkey = Editkey(e.key);
				if(editkey){addEdirDlok(editkey);}//редактирование
				return false;

			}

		});

		select_pnc();

	}
	//конец плагин карты

	//очистка
	var Clear = function(infoText){

		var info = false;
		if(!selectBlock.save){
			info = confirm(infoText);
		}else{
			info= true;
		}

		info = true; //отключена проверка на несохраненные даные

		if(info){
			$(Map).text("");
			$(fomes).text("");

			ArrayItems = [];

			BDinfo = $.parseJSON( Bd({info:true}));
			//console.log(BDinfo);
			addItemsBD(BDinfo);
			selectBlock.save=true;
		}

	}

	//загрузка не проверенных данных

//	$('area').hover(function(event) {
//	var name = event.target.id;
//	//alert (name);
//			$.get('/include/ajax.php' , {name: name}, function(data){
//				$('#name_data').html(data);
//			});
//	});





	$("#loadItem_").click(function(){

		Clear("Несохраненные даные будут утерены!");

	});

	//сохранение данных в бд
	$('body').on('submit', '.formCheck', function(){
		var add = $(this).attr('add');
		var arrFormData = $(this).serializeArray();
		var jsonFormData = $(this).serialize();
		ObIsArr(add, function(e){e.saveForm(arrFormData,jsonFormData);});

		$(this).hide(200);
		Start();
		return false;
	});


	//конец сохранение

	//изменения данных

	$('body').on('submit', '.edith5', function(){
		var edit = $(this).attr('edit');
		var edith5 = $(this).attr('edith5');
		var arrFormData = $(this).serializeArray();
		//var jsonFormData = $(this).serialize();

		SaveEdit(edit,edith5,arrFormData);
		//ObIsArr(add, function(e){e.saveForm(arrFormData,jsonFormData);});
		$(this).hide(200);
		//Start();
		return false;
	});

	//добавить блок н5
		$('body').on('click', '#AddH5', function(){
		var addh5 = $(this).attr('addh5');
		AddH5(addh5);
		return false;
	});

	//удалить блок н5
	$('body').on('click', '#deledit', function(){
		var edith5 = $(this).attr('edith5');
		var edit = $(this).attr('edit');
		DelH5(edit,edith5);
		return false;
	});


	//проверенно
	$("#check").click(function(){
		var add = $(this).attr('add');
		//console.log(add);
		Bd({save_cheak:add});
		selectBlock.save = true;
		Clear("Несохраненные даные будут утерены!");
	});

	//скачать картинку
	$("#check_img").click(function(){
		var img = $(this).attr('img');

		$.ajax({
			url: "php/loadimg.php",
			type: "POST",
			dataType: "json",
			async: false,
			data: {
				load_img: true,
				img: img
			}
		});
		selectBlock.save = true;
		Clear("Несохраненные даные будут утерены!");
	});

	//обновить
	$("#EditAdd").click(function(){
		Start();
		window.location.reload();
	});

	function Start(name){
		ArrayItems = Array(); //масив добавленых объектов
		ArrayEditItems = Array(); //масив редактирования
		$("#loadItem").click(function(){

		var name = $('input#my_id').val();
			if ( name == '' ) { var name = 2801;}

		//console.log(name);
		$('#fomes').text('');
		BDinfo =$.parseJSON( Bd({info:name})); //получить не проверенные даные из бд
		//console.log(BDinfo);
		addItemsBD();
		});
	}
//$("#loadItem").focus();

});
