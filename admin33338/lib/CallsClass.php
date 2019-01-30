<?php

class CallsClass extends MyDb
{
    public $table = "admin_mng_calls";

    public function get_adm_all_managers()
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getManager($mng_id)
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($mng_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }

    // Вставляем значения

    public function calls_insert($d)
    {
        $tmp = explode('-', $d['score_id']);
        $row_number = $tmp[0];
        $score_name_id = $tmp[1];
        $score_uid = $tmp[2];
        $m = $this -> db();

        if ($score_name_id == 97) {
            $this->table = 'admin_mng_calls_deal';
        } elseif ($score_name_id == 98) {
            $this->table = 'admin_mng_calls_phone';
        } else {
            $this->table = 'admin_mng_calls';
        }
        $q = "INSERT INTO " . $this -> table . "
      (
      score,
      score_uid,
      score_name_id,
      row_number,
      mng_id,
      insert_date
      ) VALUES (
      :score,
      :score_uid,
      :score_name_id,
      :row_number,
      :mng_id,
      :insert_date
      )
      ";

        $t = $m -> prepare($q);
        $t -> execute(array(
          ':score'        => $d['name_score_value'],
          ':score_uid'   => $score_uid,
          ':score_name_id'=> $score_name_id,
          ':row_number'   => $row_number,
          ':mng_id'       => $d['manager_id'],
          ':insert_date'=> $d['date']
        ));

        return true;
    }

    public function calls_update($d)
    {
    $tmp = explode('-', $d['score_id']);
    $row_number = $tmp[0];
    $score_name_id = $tmp[1];
    $score_uid = $tmp[2];

        if ($score_name_id == 97) {
            $this->table = 'admin_mng_calls_deal';
        } elseif ($score_name_id == 98) {
            $this->table = 'admin_mng_calls_phone';
        } else {
            $this->table = 'admin_mng_calls';
        }
        $m = $this -> db();
        $q = "UPDATE " . $this -> table . "
        SET
        score        = :score,
        row_number   = :row_number,
        mng_id       = :mng_id
        WHERE score_uid = :score_uid
        AND insert_date = :insert_date
        AND score_name_id = :score_name_id
        AND row_number = :row_number
        ";

        $t = $m -> prepare($q);
        //p($d);
        $t -> execute(array(
          ':score' => $d['name_score_value'],
          ':score_uid' => $score_uid,
          ':score_name_id' => $score_name_id,
          ':row_number' => $row_number,
          ':mng_id' => $d['manager_id'],
          ':insert_date' => $d['date'],
          ':row_number' => $row_number
        ));

        return true;
    }

    public function checker($d)
    {
      $tmp = explode('-', $d['score_id']);
      $row_number = $tmp[0];
      $score_name_id = $tmp[1];
      $score_uid = $tmp[2];
        $m = $this -> db();
        if ($score_name_id == 97) {
            $this->table = 'admin_mng_calls_deal';
        } elseif ($score_name_id == 98) {
            $this->table = 'admin_mng_calls_phone';
        } else {
            $this->table = 'admin_mng_calls';
        }
        $q = "SELECT id FROM " . $this -> table . "  WHERE DATE(insert_date) = ? AND score_uid = ? AND score_name_id = ? AND row_number = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($d['date'], $score_uid,  $score_name_id, $row_number));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    //Работаю с функцией

    public function getThingsDone($d)
    {

        $check = $this->checker($d);
        if ($check) {
            $this->calls_update($d);
        } else {
            $this->calls_insert($d);
        }
    }




    //получаем данные для подстановки в инпуты аякс
    private function getUid($calls_date,$mng_id)
    {
        $m = $this -> db();
        $q = "SELECT DISTINCT score_uid,row_number FROM admin_mng_calls
        WHERE DATE(insert_date) = :insert_date  AND mng_id = :mng_id
        ";
        $t = $m -> prepare($q);
        $t -> execute(array(':insert_date' => $calls_date, ':mng_id' => $mng_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
//Выбираем среднюю оценку по звонкам за оперделенную дату по менеджер id
    public function ajaxScoreDay($calls_date, $mng_id){
      $m = $this -> db();
      $q = "SELECT mng_id, avg_score, calls, date FROM admin_mng_calls_dayly WHERE date = ? AND mng_id = ?";
      $t = $m -> prepare($q);
      $t -> execute(array(date('Y-m-d', strtotime($calls_date)), $mng_id));
      $data = $t -> fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
    public function ajaxScoreDayLimit($limit, $mng_id){
      $m = $this -> db();
      $q = "SELECT a.*, b.username FROM admin_mng_calls_dayly a
            LEFT JOIN userlist b
            ON a.mng_id = b.id
            WHERE a.mng_id = ?
            ORDER BY date DESC LIMIT " . $limit;
      $t = $m -> prepare($q);
      $t -> execute(array($mng_id));
      $data = $t -> fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }
      public function ScoreTable($limit){
        $mngs = $this->get_adm_all_managers();
        foreach($mngs as $mng){
          $d[$mng['username']] = $this->ajaxScoreDayLimit($limit, $mng['id']);
        }
        return($d);


      }


    public function ajaxData($calls_date,$mng_id)
    {

        $m = $this -> db();
        $make_array = $this->getUid($calls_date, $mng_id);
        $data = [];
        foreach($make_array as $k => $v)
        {
        $q = "SELECT a.*, b.score as deal, c.score as tel  FROM admin_mng_calls as a
        LEFT JOIN admin_mng_calls_deal as b
        ON a.score_uid = b.score_uid
        AND a.row_number = b.row_number
        LEFT JOIN admin_mng_calls_phone as c
        ON a.score_uid = c.score_uid
        AND a.row_number = c.row_number
        WHERE DATE(a.insert_date) = ? AND a.row_number = ? AND a.mng_id = ? AND a.score_uid = ?
        ";
        $t = $m -> prepare($q);
        $t -> execute(array(date('Y-m-d', strtotime($calls_date)),$v['row_number'], $mng_id, $v['score_uid']));
        //$data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $data[] = $t -> fetchAll(PDO::FETCH_ASSOC) ;
      }

        if (!empty($data)) {
            return $data;
        } else {
            return false;
        }
    }
    public function getCallsScoreNames()
    {
        $m = $this -> db();
        $q = "SELECT * FROM admin_mng_calls_score_name";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

// Удаляет строку из нижней таблицы оценки звонков на ajax
    public function deleteScoreRows($id, $date, $mng_id){
      $m = $this -> db();
      $array = explode('-', $id);
      $q = "DELETE a,b,c FROM admin_mng_calls a
      JOIN admin_mng_calls_deal b
      ON a.score_uid = b.score_uid AND a.row_number = b.row_number AND a.mng_id = b.mng_id AND a.insert_date = b.insert_date
      JOIN admin_mng_calls_phone c
      ON a.score_uid = c.score_uid AND a.row_number = c.row_number AND a.mng_id = c.mng_id AND a.insert_date = c.insert_date
      WHERE a.score_uid = ? AND a.row_number = ? AND a.insert_date = ? AND a.mng_id = ?
      ";
      $t = $m -> prepare($q);
      $t -> execute(array($array[0], $array[1], date('Y-m-d', strtotime($date)), $mng_id));

    }

    public function getCallsByMonth($date){
        $m = $this -> db();
        $mngs = $this->get_adm_all_managers();
        foreach($mngs as $man){
        $q = "  SELECT b.username, a.date, a.calls, a.avg_score FROM `admin_mng_calls_dayly_last` as a
                LEFT JOIN userlist as b
                ON b.id = a.mng_id
                WHERE DATE_FORMAT(`date`,'%Y-%m') = ? AND a.mng_id = ?";
        $t = $m -> prepare($q);
        $date = date('Y-m',strtotime($date));
        $t -> execute(array($date, $man['id']));
        $data[] = $t->fetchAll(PDO::FETCH_ASSOC);
    }
        return($data);
    }
}
