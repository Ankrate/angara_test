<?php
class MyInsert extends MyDb {
public $filee = '/file.csv';
    private function select_file() {
        $m = $this -> db();
        $q = "SELECT projname,id FROM adm_projects";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function insert() {
        $m = $this -> db();
        
        $row = 1;
        if (($handle = fopen(__DIR__ . $this->filee, "r")) !== FALSE) {

            while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
                //p($data);
            //$data[1] = strtotime($data[1]);
            //$data[1] = str_replace('.', '-', $data[1]);
                $sql = "INSERT INTO adm_linkbuilding (
              project_id,
              date,
              keywords,
              ancor,
              url,
              url_review,
              attendance,
              chargeble,
              cost            
              ) VALUES (
              :project_id,
              :date,
              :keywords,
              :ancor,
              :url,
              :url_review,
              :attendance,
              :chargeble,
              :cost
              )";
                //$data[1] = date('Y-m-d',$data[1]);
                //echo $data[1] . '<br>';
                $q = $m -> prepare($sql);
                 $q -> execute(array(':project_id' => $data[0], ':date' => $data[1], ':keywords' => $data[2], ':ancor' => $data[3], ':url' => $data[4], 'url_review' => $data[5], 'attendance' => $data[6], 'chargeble' => $data[7], 'cost' => $data[8]));
                 $row++;

                 //p($data);
                 

            }

            fclose($handle);
            //print ' Вставлено ' . $row . ' строк';
        }
        return TRUE;
    }

}