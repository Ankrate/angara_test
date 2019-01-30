<?php
class LinksPlan extends MyDb {

    public $data;
    public function links() {
        $m = $this -> db();
        $q = "SELECT b.projname, a.* FROM adm_linkbuilding as a
        LEFT JOIN adm_projects as b
        ON a.project_id = b.id
        WHERE (date  BETWEEN DATE_SUB(CURDATE(), INTERVAL 10 DAY) AND DATE_ADD(CURDATE(), INTERVAL 5 DAY))";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function links_expired() {
        $m = $this -> db();
        $q = "SELECT b.projname, a.* FROM adm_linkbuilding as a
        LEFT JOIN adm_projects as b
        ON a.project_id = b.id
        WHERE (date < DATE_SUB(CURDATE(), INTERVAL 10 DAY)) AND a.url_review = ''";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function checked() {
        $m = $this -> db();
        $d = $this -> data;
        $q = "UPDATE adm_linkbuilding SET
        url_review = :url_review,
        attendance = :attendance,
        chargeble = :chargeble,
        cost = :cost
        WHERE id = :id";
        $t = $m -> prepare($q);
        $t -> execute(array(':url_review' => $d['url_review'], ':attendance' => $d['attendance'], ':chargeble' => $d['chargeble'], ':cost' => $d['cost'], ':id' => $d['id']));
        $count = $t -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function show_expired() {
        $links_expared = $this -> links_expired();
        foreach ($links_expared as $n) {
            if ($n['url_review'] == '') {
                return true;
            }
        }
    }

    public function bought_project() {
        $m = $this -> db();
        $q = "SELECT b.projname, COUNT(a.id) as count FROM adm_linkbuilding as a
        INNER JOIN adm_projects as b
        ON a.project_id = b.id
        WHERE a.url_review <> ''
        GROUP BY a.project_id";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }
    public function links_by_month() {
        $m = $this -> db();
        $q = "SELECT DATE_FORMAT(a.date,'%M %Y') as date, COUNT(a.id) as count FROM adm_linkbuilding as a
        INNER JOIN adm_projects as b
        ON a.project_id = b.id
        WHERE a.url_review <> ''
        GROUP BY MONTH(a.date),YEAR(a.date)
        ORDER BY MONTH(a.date)";
        $t = $m -> prepare($q);
        $empty = NULL;
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }
    
    
    public function links_by_month_sum() {
        $m = $this -> db();
        $q = "SELECT DATE_FORMAT(a.date,'%M %Y') as date, COUNT(a.id) as count FROM adm_linkbuilding as a
        INNER JOIN adm_projects as b
        ON a.project_id = b.id
        WHERE a.url_review <> ''
        GROUP BY MONTH(a.date),YEAR(a.date)
        ORDER BY MONTH(a.date)";
        $t = $m -> prepare($q);
        $empty = NULL;
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $i=0;
        $new[] = array('date'=> $data[0]['date'],'count'=> $data[0]['count']);
        $sum = $data[0]['count'];
        foreach($data as $k=>$d){
            
            
            if($k == 0){
                continue;
            }
            ++$i;
            $sum += $data[$i]['count'];
            
            $new[$i] = array('date'=> $d['date'], 'count' => $sum);
            
          // p($d); 
        }
       // p($sum);
      // p($new);
        return $new;
    }

}
