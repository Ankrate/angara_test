<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/catalogue/lib/App.php';
class CatCar1 extends App {
    public $prefix = 'p1';
    public $model = 21;

    public function show(){
        echo $this->prefix;
    }

    public function get_car_name($id) {
    $m = db();
    $q = 'SELECT * FROM ang_cars_cat WHERE id = ?';
    $t = $m -> prepare($q);
    $t -> execute(array($id));
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
 }
    //Функция выбора на главной

    public function first_query() {
        $m = db();
        $table = $prefix . '_h1';
        $q = 'SELECT * FROM '.$table.' WHERE id = 21';
        $t = $m -> prepare($q);
        $t -> execute(array($table));
        $data = $t -> fetchAll(PDO::FETCH_NUM);
        return $data;
    }//Конец функции

    public function second_query($id) {

        $m = db();
        $table = $this->prefix . '_h2';
        $q = 'SELECT * FROM '.$table.' WHERE `id_h1` = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($this->model));
        $data = $t -> fetchAll(PDO::FETCH_NUM);

        return $data;

    }//Конец функции

    public function third_query($id) {
        $m = db();
        $table = $this->prefix . '_h3';
        $q = 'SELECT * FROM '.$table.' WHERE `id_h2` = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_NUM);
        return $data;
    }//Конец функции

    public function get_first_title($id) {
        $m = db();
        $table = $this->prefix . '_h2';
        $q = 'SELECT name FROM '.$table.' WHERE `id` = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_NUM);
        return $data;
    }

    public function get_second_title($id) {
        $m = db();
        $table = $this->prefix . '_h3';
        $q = 'SELECT name, id_h2 FROM '.$table.' WHERE `id` = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_NUM);
        return $data;
    }

     public function forth_query($id) {
        $m = db();
        $table = $this->prefix . '_h4';
        $table2 = $this->prefix . '_h5';
        //$q = 'SELECT * FROM '.$table.' WHERE `id_h3` = ?';
        $q = "select
                    a.id,b.id as h5_id, a.title, a.coords, b.numer ,c.ang_name, c.price, c.cat, c.1c_id, a.keyd,a.img, b.id_h4
                    from
                    ".$table." as a
                    left join ".$table2." as b
                    on a.id = b.id_h4
                    left join angara as c
                    on c.cat = b.numer
                    where a.id_h3 = ?
                    ";
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;

    }//Конец функции

    public function get_main_text($id) {
        $m = db();
        $table = 'ang_catalog_main_page';
        $q = 'SELECT text FROM '.$table.' WHERE `car_id` = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}
