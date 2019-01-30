<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/catalogue/init.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);

class Catalog extends App {

    private $cont = array();
    private $name = 1;
    private $myarr = 2;
    /*
     * Getting car names for catalogue
     */
   

    public function forth_query($pdo, $id, $row_area) {
        global $row_area;
        print "<div class='span_all'>Теперь жми на маленький синий прямоугольничек!</div>";
        $stmt = $pdo -> prepare("SELECT * FROM `h4` WHERE `id_h3` LIKE '$id'  LIMIT 1");
        $stmt -> execute();
        $row = $stmt -> fetch();

        $img = "/catalogue" . $row[3];
        //echo "<figure class='div_center2'>";
        echo("<img class='mapper' id='A' usemap='#map' src='$img' alt='$row_area на Портер' />");
        echo("<map  name='map' id='map'>");
        //echo "</figure>";

        $query = "SELECT * FROM `h4` WHERE `id_h3` = $id ";

        $host = $_SERVER['HTTP_HOST'];

        foreach ($pdo->query($query) as $line) {

            //echo( "<area id='blue' rel='green,red' shape='rect' coords='$line[5]' href='catalogue.php?cat=$line[0]'>");

            echo("<area id='$line[0]' class='blue' rel='green,red' shape='rect' coords='$line[5]' href='http://$host/cat-number-$line[0]/' alt='$line[6] на Портер'>");
            //echo( "<area id='$line[0]' rel='green,red' shape='rect' coords='$line[5]' href='javascript:void(0);' alt='$line[6] на Портер'>");
        }
        echo '</map>';
    }//Конец функции

    public function select_angara($pdo, $cat) {

        //Выполнение SQL запроса
        //print "<table class='tab1'>";
        $query = "SELECT * FROM `h5` WHERE `id_h4` LIKE '$cat' ";
        foreach ($result1 = $pdo->query($query) as $line) {

            //print $line['2']."<br />"; //Вывод на печать каталожных номеров
            $line[2] = substr($line[2], 0, 7);
            $query2 = "SELECT * FROM `angara` WHERE `cat` LIKE '%$line[2]%' ";
            //$line2 = array();
            foreach ($result = $pdo->query($query2) as $line2) {

                $porter = "/porter-" . $line2[3] . "-" . $line2[6] . "/";
                //Path SEO URL
                if ($line2[2] <= 2 and $line2[2] != 0) {
                    $est = "Есть";
                } elseif ($line2[2] == 0) {
                    $est = "1 день";
                } else {
                    $est = "Много";
                }

                print "<div class='row b1c-good'>";

                print "<div class='col c50 b1c-name'>";
                print "<a href='$porter'>$line2[1] </a></div>";
                print "<div class='col c25'>$est</div>";
                print "<div class='col c25 b1c-price'>$line2[4]</div>";
                print "<div class='col c25'><input type='button' class='b1c' value='Купи за 1 клик'></div>";

                echo " </div>";

                $count = $result -> rowCount();

                $this -> myarr = $line2[3];
                $this -> name = $line2[1];

                //	print '<h1><p>Эта позиция на заказ чувак!</p><p> Жми на другую</p></h1>';
                //header('Refresh: 2; URL=http://porter.angarasolaris.com/first.php');
            }

            $this -> myarr = $line2[3];
            $this -> name = $line2[1];

            //var_dump($myarr);

        }

        $count1 = $result1 -> rowCount();
        if ($count1 == 0 or $count == 0) {
            $myarr = 987654321;

            header('Location: /page/');
        }

        //echo $count;
        return array($this -> myarr, $this -> name);

    }//Конец функции

    public function supercat($pdo, $id) {
        //print '<h1>Теперь жми на маленький синий прямоугольничек!</h1>';
        $stmt = $pdo -> prepare("SELECT * FROM `h4` WHERE `id_h3` LIKE '$id'  LIMIT 1");
        $stmt -> execute();
        $row = $stmt -> fetch();
        $img = $row[3];
        echo "<div style='background-image: url(" . $img . "); height: 900px; width: 900px; background-repeat: no-repeat;'>";

        //echo ("<img style='z-index:-100;' src='$img' />");

        $query = "SELECT * FROM `h4` WHERE `id_h3` = $id ";
        foreach ($pdo->query($query) as $line) {
            $x = explode(",", $line[5]);

            echo "<a href=catalogue.php?cat=" . $line[0] . "><div  style='margin-top: " . $x[0] . "px; margin-left: " . $x[1] . "px; position: absolute; border: 1px solid rgb(0, 0, 0); width: 43px; height: 15px;' class='coord'><img width='43' height='15' src='img/1x1.gif'></div></a>";

        }

        echo "</div>";

    }//Конец функции

    public function breadCrumbs() {

        $crumbs = explode("/", $_SERVER["REQUEST_URI"]);
        foreach ($crumbs as $crumb) {
            echo ucfirst(str_replace(array(".php", "_"), array("", " "), $crumb) . ' ');
        }

    }//Конец функции

    public function meta_last($pdo, $id) {
        //print '<h1>Теперь жми на маленький синий прямоугольничек!</h1>';
        $stmt = $pdo -> prepare("SELECT name FROM `h3` WHERE `id` = '$id'  LIMIT 1");
        $stmt -> execute();
        $row = $stmt -> fetch();
        return ($row);

    } //Конец функции

}//Конец класса

class metaSelect extends ArrayIterator {
    public function meta_catnumber_new($pdo, $cat) {
        //print '<h1>Теперь жми на маленький синий прямоугольничек!</h1>';
        $stmt = $pdo -> prepare("SELECT name FROM `angara` WHERE `1c_id` = '$cat'  LIMIT 1");
        $stmt -> execute();
        $row = $stmt -> fetch();
        return ($row);

    }//Конец функции

    public function third_query_title($pdo, $id) {
        $result = array();
        //print ("<span class='span_all'>Еще куда нибудь жми!</span>");
        $query = $pdo -> prepare("SELECT * FROM `h2` WHERE `id` = $id ");
        $query -> execute();
        $data = $query -> fetch();
        $result = new metaSelect($data);
        return $result;

        return $result;
    }//Конец функции

    public function before_last_title($pdo, $cat) {
        $result = array();

        $query = "SELECT * FROM `h5` WHERE `id_h4` LIKE '$cat' ";
        foreach ($result1 = $pdo->query($query) as $line) {
            $query2 = "SELECT * FROM `angara` WHERE `cat` LIKE '%$line[2]%' ";
            //$line2 = array();
            //print_r($line);
            foreach ($result = $pdo->query($query2) as $line2) {
                //print_r($line2);
                $this -> myarr = $line2[3];
                $this -> name = $line2[1];
            }
            $this -> myarr = $line2[3];
            $this -> name = $line2[1];
        }

        return array($this -> myarr, $this -> name);
    }//Конец функции

    public function func_query($pdo, $subject) {
        $query = $pdo -> prepare("SELECT $subject[0] FROM `$subject[1]` WHERE $subject[2] = '$subject[3]'");
        //$pdo->query($query);
        $query -> execute();
        $row = $query -> fetch();
        return ($row);
        //var_dump($row);
    }

    //Конеw функцииы

} //Конец класса
