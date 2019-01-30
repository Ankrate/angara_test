<?php
function cat($string) {
	$converter = array('21' => 'Двигатель', '22' => 'Двигатель', '23' => 'Двигатель', '24' => 'Двигатель', '51' => 'Задняя подвеска', '54' => 'Задняя подвеска', '55' => 'Задняя подвеска', '52' => 'Задний мост', '53' => 'Задний мост', '41' => 'Сцепление', '49' => 'Карданный вал', '43' => 'Коробка передач', '56' => 'Рулевое управление', '57' => 'Рулевое управление', '58' => 'Тормозная система', '59' => 'Тормозная система', '6' => 'Кузовные', '7' => 'Кузовные', '97' => 'климат контроль', '95' => 'Электрооборудование', '92' => 'Осветительное оборудование', '98' => 'Стеклоочиститель', '28' => 'Впуск выпуск', '91' => 'Предохранители, домкрат', '36' => 'Электрооборудование двигателя', '37' => 'Электрооборудование двигателя', '39' => 'Электрооборудование двигателя', '96' => 'Электрооборудование');

	return strtr($string, $converter);

}//End of func

function print_image($cat_number) {

	global $name;
	$kartinka;
	global $id;

	$dir = "img/foto_parts/";
	//echo $dir;
	$id_c = substr($cat_number, 0, 7);
	
	$pattern = strtolower($dir.'*'.'-'.$id.'*'.'jpg');
	//echo $pattern;
	//$kartinka = array();
	foreach (glob($pattern) as $filename) {
		$link_big = str_replace('tmb', 'foto_parts', $filename);

		$link = pathinfo($filename);
		$link_big = $link['filename'];
		//echo $filename;
		//echo"</br>";
		$big_image = str_replace('tmb', 'foto_parts', $filename);

		$kartinka[] = "<a href='/$big_image' class='fancybox' rel='group'><img src='/$filename' title='$name' alt='$name' /></a>";

	}
	if (!isset($filename) or $filename == NULL) {
		//echo "Nothing";
		$pattern = strtolower($dir . $id_c . '*' . 'jpg');
		foreach (glob($pattern) as $filename) {
		$link_big = str_replace('tmb', 'foto_parts', $filename);

		$link = pathinfo($filename);
		$link_big = $link['filename'];
		//echo $filename;
		//echo"</br>";
		$big_image = str_replace('tmb', 'foto_parts', $filename);

		$kartinka[] = "<a href='/$big_image' class='fancybox' rel='group'><img src='/$filename' title='$name' alt='$name' /></a>";

	}
	}
	
	return array($kartinka);
} //End of function
