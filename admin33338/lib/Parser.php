<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/CoreOne.php');
//include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/simple_html_dom.php');

class Parser extends CoreOne {

    public function get_global($url, $depth, $maxDepth) {

        $result = $this -> get_web_page($url);
        $html = new simple_html_dom();
        $html -> load($result);
        if ($depth <= $maxDepth) {
            foreach ($html->find('.section-list-img a') as $element) {
                $url2 = 'http://www.dvsavto.ru' . $element -> href;
               //echo $url2 . '<br>';
                $this -> get_global($url2, $depth + 1, $maxDepth);
                $this->test($url2);

            }
            
            $html -> clear();
            unset($html);
            //return $array;
        }

    }

    private function test($url) {
        $result = $this -> get_web_page($url);
        $html = new simple_html_dom();
        $html -> load($result);
        foreach ($html->find('.element-name') as $element) {
            if($element->plaintext){
                $el = $this->cut_str($element->plaintext );
            echo $el . '<br>';
              $data = $this->split_sting($el);
              //p($data);
              if(!isset($data[1]) OR !isset($data[0])){
                  continue;
              }
              //$data[1] = $this->cut_str($data[1]);
              $this->insert_spec('parse_globalavto', $data[1], $data[0], 0);
            }else{
                continue;
            }
        }
        $html -> clear();
        unset($html);
    }
    
    private function split_sting($string){
        
        $str = explode(':', $string);
        
        return $str;
    }
    private function cut_str($str){
        $str = preg_replace('#^\s+#u','',$str);
        $str = preg_replace('#\s+Артикул#u','', $str);
        $str = preg_replace('#\s+$#u','',$str);
        return $str;
    }

    public function findlinks($url, $maxDepth) {
        //$this->truncate('parse_zaptop');

        $i = 0;
        while ($i <= $maxDepth) {

            $u = $url . '?page=' . $i;
            $i++;
            //echo $u . '<br>';
            $result = $this -> get_web_page($u);
            $html = new simple_html_dom();
            $html -> load($result);

            foreach ($html->find('tr') as $element) {

                $cat = trim($element -> find('.views-field-field-code-value', 0) -> plaintext);
                $cat = str_replace('-', '', $cat);
                $name = trim($element -> find('.views-field-title', 0) -> plaintext);
                $price = $element -> find('.views-field-field-price-amount', 0) -> plaintext;
                $price = preg_replace('/[^0-9]/u', '', $price);
                if (intval($price) == 0) {
                    continue;
                }
                $this -> insert_spec('parse_zaptop', $cat, $name, $price);
            }

            $html -> clear();
            unset($html);
        }
    }

    public function parse_zapkia($url, $maxDepth) {

        $result = $this -> get_web_page($url);
        $html = new simple_html_dom();
        $html -> load($result);
        $t = $html -> find('table[width=100%]', 0);
        foreach ($html->find('tr') as $f) {
            //var_dump($f);
            @$name = $f -> find('a.tov b', 0) -> plaintext;
            @$price = $f -> find('.textcen1 b', 0) -> plaintext;
            if (!$price) {
                continue;
            } elseif (!$name) {
                continue;
            }
            $pattern = '/[\dA-Z]{10}/';
            if (preg_match($pattern, $name, $mat) == 0) {
                $pattern = '/[\dA-Z-]{11}/';
                preg_match($pattern, $name, $mat);
            }
            @$cat = str_replace('-', '', $mat[0]);
            //echo $n . '----' . $p . '<br>';
            $this -> insert_spec('parse_zapkia', $cat, $name, $price);
            // $item = array($name,$price,$cat);
            //$array[] = $item;
        }

        //$this->p($array);
        $html -> clear();
        unset($html);

    }

    public function parse_zapkia_excel($url) {
        $result = $this -> get_web_page($url);
        $html = new simple_html_dom();
        $html -> load($result);
        $t = $html -> find('table[width=100%]', 0);
        foreach ($html->find('tr') as $f) {
            //var_dump($f);
            @$name = $f -> find('a.tov b', 0) -> plaintext;
            @$price = $f -> find('.textcen1 b', 0) -> plaintext;
            if (!$price) {
                continue;
            } elseif (!$name) {
                continue;
            }
            $pattern = '/[\dA-Z]{10}/';
            if (preg_match($pattern, $name, $mat) == 0) {
                $pattern = '/[\dA-Z-]{11}/';
                preg_match($pattern, $name, $mat);
            }
            @$cat = str_replace('-', '', $mat[0]);
            //echo $n . '----' . $p . '<br>';
            //$this -> insert_spec('parse_zapkia', $cat, $name, $price);
            $item = array($cat, $name, $price);
            $array[] = $item;
        }

        return ($array);
        $html -> clear();
        unset($html);

    }

    public function ex_zap($url) {
        foreach ($url as $u) {
            $t[] = $this -> parse_zapkia_excel($u);

        }
        return $t;
    }

    private function insert_spec($table, $p1, $p2, $p3) {
        $conn = $this -> db();

        $sql = "INSERT INTO " . $table . " (cat,name,price) VALUES (:cat,:name,:price)";
        $q = $conn -> prepare($sql);
        if ($q -> execute(array(':cat' => $p1, ':name' => $p2, ':price' => $p3))) {

            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_zaptop($table) {
        $m = $this -> db();
        $q = "SELECT * FROM {$table}";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
 

}
