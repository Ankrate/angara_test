<?php
class Content {
    
    public $colors = array("#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", "#880e4f", "#e67e22", "#e74c3c", "#880e4f", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#03a9f4", "#ff4444","#CC0000", "#ff4444", "#ffbb33", "#33b5e5", "#00C851", "#0099CC", "#aa66cc", "#0d47a1", "#2BBBAD", "#9933CC", "#00C851","#3F729B", "#37474F", "#d81b60", "#4a148c", "#CC0000", "#ffbb33", "#FF8800", "#007E33", "#0099CC", "#00695c", "#0d47a1", "#9933CC", "#212121", "#3E4551", "#1C2331", "#263238", "#ff4444", "#ffbb33", "#00C851", "#33b5e5", "#2BBBAD", "#4285F4", "#aa66cc", "#2E2E2E", "#4B515D", "#3F729B", "#37474F", "#CC0000", "#ffbb33", "#FF8800", "#007E33", "#0099CC", "#00695c", "#0d47a1", "#9933CC", "#212121", "#3E4551", "#1C2331", "#263238", "#ff4444", "#ffbb33", "#00C851", "#33b5e5", "#2BBBAD", "#4285F4", "#aa66cc", "#2E2E2E", "#4B515D", "#3F729B", "#37474F", "#CC0000", "#ffbb33", "#FF8800", "#007E33", "#0099CC", "#00695c", "#0d47a1", "#9933CC", "#212121", "#3E4551", "#1C2331", "#263238", "#ff4444", "#ffbb33", "#00C851", "#33b5e5", "#2BBBAD", "#4285F4", "#aa66cc", "#2E2E2E", "#4B515D", "#3F729B", "#37474F", "#CC0000", "#ffbb33", "#FF8800", "#007E33", "#0099CC", "#00695c", "#0d47a1", "#9933CC", "#212121", "#3E4551", "#1C2331", "#263238", "#ff4444", "#ffbb33", "#00C851", "#33b5e5", "#2BBBAD", "#4285F4", "#aa66cc", "#2E2E2E", "#4B515D", "#3F729B", "#37474F");
    
    
    
    
    
    public function get_art_list($limit) {
        $m = db();
        $q = "SELECT id, title, mini_img, text, view FROM data ORDER BY RAND()  LIMIT {$limit}";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function cutoff($text, $length) {
    if (strlen($text) > $length) {
        $text = strip_tags($text);
        $text = substr($text, 0, strpos($text, ' ', $length));
    }

    return $text . '...';
}
    public function get_art($id) {
        $m = db();
        $q = "SELECT * FROM data WHERE id = ? ";
        $q2 = "UPDATE data SET view = view + 1  WHERE id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($id));        
        if($data = $t -> fetchAll(PDO::FETCH_ASSOC)){
            $sth2 = $m ->prepare($q2);
            $sth2 -> execute(array($id));
            return $data;
        } else {
            return FALSE;
        }
        
    }
    
    /*
     * Getting products for main page
     */

     public function get_main_prod($limit) {
        $m = db();
        $q = "SELECT s.*, a.ang_name, a.1c_id, a.price, a.cat  FROM ang_spec s
        inner join angara a
        on s.1c_id = a.1c_id
        LIMIT {$limit}";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
     
     /*
      * Getting subcat description
      */
     public function get_descr($id,$car) {
         
        $m = db();
        $q = "SELECT * FROM content_description WHERE cat_id = ? AND car = ? ";
        
        $t = $m -> prepare($q);
        $t -> execute(array($id, $car));        
        if($data = $t -> fetchAll(PDO::FETCH_ASSOC)){
            return $data;
        } else {
            return FALSE;
        }
        
    }
  public function get_main_first($id) {
        $m = db();
        $q = "SELECT id, title, text FROM data WHERE id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;   
  }
}
