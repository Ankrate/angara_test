<?php



/*
    Класс создает соединение с базой данных
  */
class DataBase
{
    public static $mConnect;    // Хранит результат соединения с базой данных
    public static $mSelectDB;   // Хранит результат выбора базы данных

    // Метод создает соединение с базой данных
    public static function Connect($host, $user, $pass, $name)
    {
        // Пробуем создать соединение с базой данных
        self::$mConnect = mysqli_connect($host, $user, $pass);

        // Если подключение не прошло, вывести сообщение об ошибке..
        if(!self::$mConnect)
        {
            echo "<p><b>К сожалению, не удалось подключиться к серверу MySQL</b></p>";
            exit();
            return false;
        }

        // Пробуем выбрать базу данных
        self::$mSelectDB = mysqli_select_db(self::$mConnect,$name );

        // Если база данных не выбрана, вывести сообщение об ошибке..
        if(!self::$mSelectDB)
        {
            echo "<p><b>".mysqli_error()."</b></p>";
            exit();
            return false;
        }
         mysqli_set_charset(self::$mConnect, 'utf8');
        // Возвращаем результат
        return self::$mConnect;
    }

	// Метод возвращает id посленей записаной
	public static function id_save(){
	 return mysqli_insert_id();
	}

    // Метод закрывает соединение с базой данных
    public static function Close()
    {
        // Возвращает результат
        return mysqli_close(self::$mConnect);
    }

}

//класс работы с пост данными

class BD_h5 extends DataBase {


    //public $prefix = "p1_"
    public static $prefix = "p1";
    //public static $prefix = "starex";

//получить не проверенную запись из h3

public static function h3_check($name)
{


    //$sql = "SELECT `id`,`id_h2`,`name`,`url`,`img` FROM `h3` WHERE  `checkKey` is NULL LIMIT 1";
  	 $sql = "SELECT `id`,`id_h2`,`name`,`url`,`img` FROM `" . self::$prefix . "_h3` WHERE  `id` = '$name' LIMIT 1";
    $resSQL = mysqli_query(self::$mConnect,$sql);
    if (mysqli_num_rows($resSQL) == 0) {
        $res[0] = 0;
    }else{
		$res[0] = mysqli_fetch_assoc($resSQL);
		$res[1] = BD_h5::h4_check($res[0]['id']);
		foreach($res[1] as $key=>$val){
			$res[2][$key] = BD_h5::h5_check($val['id']);
		}

	}


    return $res;
}

public static function h4_check($id_h3)
{

    $sql = "SELECT * FROM `" . self::$prefix . "_h4` WHERE  `id_h3` = '$id_h3'";
    $resSQL = mysqli_query(self::$mConnect,$sql);
    if (mysqli_num_rows($resSQL) == 0) {
        $res = 0;
    }else{
		while ($row = mysqli_fetch_assoc($resSQL)) {
        $res[]= $row;
    }
	}
    return $res;
}

public static function h5_check($id_h4)
{

    $sql = "SELECT * FROM `" . self::$prefix . "_h5` WHERE  `id_h4` = '$id_h4'";
    $resSQL = mysqli_query(self::$mConnect,$sql);
    if (mysqli_num_rows($resSQL) == 0) {
        $res = 0;
    }else{
		while ($row = mysqli_fetch_assoc($resSQL)) {
        $res[]= $row;
    }
	}
    return $res;
}

//обновимть запись h5
public static function update_h5($id_h5,$numer_h5,$description_h5,$count_h5,$period_h5)
{

$resSQL = false;
$description_h5 = str_replace("'", '"', $description_h5);
$numer_h5 = str_replace("'", '"', $numer_h5);
$period_h5 = str_replace("'", '"', $period_h5);
$id_h5 =(int)$id_h5;
$count_h5 =(int)$count_h5;
$sql = "UPDATE `" . self::$prefix . "_h5` SET
             `numer` = '$numer_h5' ,
             `description` = '$description_h5' ,
             `count` = '$count_h5',
             `period` = '$period_h5'
			 WHERE `id` = '$id_h5'

			 ";

$resSQL = mysqli_query(self::$mConnect,$sql) or die(mysqli_error());

return $resSQL;
}

//обновимть запись h4
public static function update_h4($id_h4,$keyd,$title,$title2)
{

$resSQL = false;
$title = str_replace("'", '"', $title);
$title = str_replace("'", '"', $title);
$keyd = str_replace("'", '"', $keyd);
$id_h4 =(int)$id_h4;

$sql = "UPDATE `" . self::$prefix . "_h4` SET
             `keyd` = '$keyd' ,
             `title` = '$title' ,
             `title2` = '$title2'
			 WHERE `id` = '$id_h4'

			 ";

$resSQL = mysqli_query(self::$mConnect,$sql) or die(mysqli_error());

return $resSQL;
}

//добавить новый
public static function add_h5($id_h3_h4,$img_h4,$keyd_h4,$coords_h4,$title_h4,$title2_h4,$numer_h5,$description_h5,$count_h5,$period_h5)
{

//проверка дубля
$sql = "SELECT `id_h3` FROM `" . self::$prefix . "_h4` WHERE `id_h3`='$id_h3_h4' and `coords`='$coords_h4' LIMIT 1";

$resSQL = mysqli_query(self::$mConnect,$sql)or die(mysqli_error());

//mysqli_num_rows($resSQL)<=0
if(1 > 0)
{

		//запись
		$sql = "INSERT INTO `" . self::$prefix . "_h4`
		(
		`id_h3`,
		`url`,
		`img`,
		`keyd`,
		`coords`,
		`title`,
		`title2`
		)
		VALUES
		(
		$id_h3_h4,
		'',
		'$img_h4',
		'$keyd_h4',
		'$coords_h4',
		'$title_h4',
		'$title2_h4'
		)";

		mysqli_query(self::$mConnect,$sql) or die(mysqli_error());

		//$sql = "SELECT * FROM " . self::$prefix . "_h4 ORDER BY id DESC LIMIT 0, 1";

		//$resSQL = mysqli_query(self::$mConnect,$sql) or die(mysqli_error());
		//$id_h4_h5 = mysqli_fetch_assoc($resSQL['id']);




        $q = "INSERT INTO " . self::$prefix . "_h5
		(
		`id_h4`,
		`numer`,
		`description`
		 )
		 VALUES
		 (
		 (SELECT id FROM " . self::$prefix . "_h4 ORDER BY id DESC LIMIT 0, 1),
		 '$numer_h5',
		 '$description_h5'
     )";

		$res = mysqli_query(self::$mConnect,$q) or die(mysqli_error());
}else{
		$resSQL = false;
}

return $resSQL;
}

	//запись проверена
public static function save_check($id_h3)
{
	$sql = "UPDATE `" . self::$prefix . "_h3` SET
				`checkkey`=1 WHERE `id`='$id_h3'";
	$resSQL = mysqli_query(self::$mConnect,$sql) or die(mysqli_error());

return $resSQL;
}

	//добавит пустую запись в h5
	public static function add_h5inset($id_h4)
	{
		$resSQL = false;
		$id_h4 = (int)$id_h4;
		if($id_h4>0){
			$sql = "INSERT INTO `" . self::$prefix . "_h5`(
		`id_h4`,
		`numer`,
		`description`,
		`count`,
		`period`)
		VALUES
		('$id_h4','','','','')";
			$resSQL = mysqli_query(self::$mConnect,$sql) or die(mysqli_error());
		}


		return $resSQL;
	}

	//удаляет запись из h5
	public static function del_h5($id_h5)
	{
		$resSQL = false;
		$id_h5 = (int)$id_h5;
		if($id_h5>0){
			$sql = "DELETE FROM `" . self::$prefix . "_h5` WHERE `id`='$id_h5'";
			$resSQL = mysqli_query(self::$mConnect,$sql) or die(mysqli_error());
		}


		return $resSQL;
	}

}//class
