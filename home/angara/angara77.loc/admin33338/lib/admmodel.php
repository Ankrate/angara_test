<?php
class Admmodel {
    public function get_img_list($car, $category = FALSE) {
        if ($category == FALSE OR $category == 'nh') {
            $q = "SELECT ang_name, 1c_id, cat  FROM angara WHERE ang_name LIKE '%{$car}%'";
        } else {
            $q = "SELECT ang_name, 1c_id, cat  FROM angara WHERE ang_name LIKE '%{$car}%' AND parent = {$category}";
        }
        $m = db();
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //return $data;
        foreach ($data as $v) {

            if ($filew = $this -> get_image($v['1c_id']) == TRUE) {
                continue;
            }
            @$mu[] = $v;
        }
        return @$mu;
    }

    private function get_image($id) {
        $f = '';
        $dir = ANG_ROOT . "img/parts/";
        $pattern = strtolower($dir . '*-' . $id . '\.{jpg,png,gif}');
        foreach (glob($pattern, GLOB_BRACE) as $filename) {
            $end = explode('/', $filename);
            $file = (end($end));
            //$f = $file;
        }
        if (isset($file)) {
            //var_dump( $file);
            return $file;
        } else {

            return FALSE;
        }

    }//Конец функции

}
