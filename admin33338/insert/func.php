<?php

function p($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}//Конец функции

function db() {

    try {
        $dsn = 'mysql:dbname=' . ANG_DBNAME . ';host=' . ANG_HOST;
        $pdo = new PDO($dsn, ANG_DBUSER, ANG_DBPASS);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo -> exec("set names utf8");

    } catch(PDOException $e) {
        echo $e -> getMessage();
    }
    return $pdo;
}

function angara_insert() {
    $m = db();
    //$truncate = 'TRUNCATE TABLE angara';
    //$t = $m -> prepare($truncate);
    //$t -> execute();
    $row = 1;
    if (($handle = fopen(__DIR__ . '/price/' . PRICE, "r")) !== FALSE) {

        while (($data = fgetcsv($handle, 500000, ";")) !== FALSE) {
            //p($data);
           if (!isset($data[3]) OR $data[3] == '') {
               continue;
            }
           if (!isset($data[2]) OR $data[2] == '' OR $data[2] == 0) {
               continue;
            }
            @$data[1] = preg_replace('!(?:\xc2\xa0|[\pZ\s]++)++!', '', (int)$data[1]);

            @$data[2] = preg_replace('!(?:\xc2\xa0|[\pZ\s]++)++!', '', (int)$data[2]);
            if(strlen($data[3]) > 19 ){
                $data[3] = 0;
            }
            @$data[3] = preg_replace('!(?:\xc2\xa0|[\pZ\s]++)++!', '', $data[3]);
            @$data[4] = preg_replace('!(?:\xc2\xa0|[\pZ\s]++)++!', '', (int)$data[4]);
            @$data[5] = preg_replace('!(?:\xc2\xa0|[\pZ\s]++)++!', '', (int)$data[5]);
            if(!isset($data[7]) OR strlen($data[7]) > 5){
                $data[7] = 0;
            }
            @$data[7] = preg_replace('!(?:\xc2\xa0|[\pZ\s]++)++!', '', $data[7]);
            @$data[7] = preg_replace('#[\,\.]\d+$#', '', $data[7]);
            
            @$data[3] = str_replace('.','',$data[3]);
            @$data[3] = str_replace('-','',$data[3]);
            @$data[6] = preg_replace('/^(\s+)|([^А-я\s\,\.A-z0-9\(\)\_])/ui', '', $data[6]);
            @$data[8] = preg_replace('!(?:\xc2\xa0|[\pZ\s]++)++!', '', $data[8]);
            @$data[9] = trim($data[9]);
            @$data[0] = trim($data[0]);
            if(!isset($data[10])){
                $data[10] = 'NoBrand';
            }

            $sql = "INSERT INTO angara (
              ang_name,
              nal,
              cat,
              price,
              description,
              1c_id,
              parent,
              ang_sort,
              car,
              brand
              ) VALUES (
              :ang_name,
              :nal,
              :cat,
              :price,
              :description,
              :1c_id,
              :parent,
              :ang_sort,
              :car,
              :brand
              ) ON DUPLICATE KEY UPDATE ang_name=:ang_name, cat=:cat, price=:price, description=:description, parent=:parent, ang_sort=:ang_sort, car=:car, brand=:brand";

            $q = $m -> prepare($sql);
            if ($q -> execute(array(':ang_name' => $data[0], ':nal' => $data[1], ':cat' => $data[3], ':price' => $data[7], ':description' => $data[6], ':1c_id' => $data[2], ':parent' => $data[4], ':ang_sort' => $data[5], ':car' => $data[9], ':brand' => $data[10])))
                $row++;

            //p($data);
        }
        fclose($handle);
        print ' Вставлено ' . $row . ' строк';
    }
    return TRUE;
}

function test() {
    $handle = fopen('php://memory', 'w+');
    fwrite($handle, preg_replace('#[^A-zА-я\d\.\,\s\-\:\;]#ui', '', file_get_contents('price/all.csv')));
    rewind($handle);
    while (($row = fgetcsv($handle, 60000, ';')) !== false)
    // p($row);
        fclose($handle);
}

function val_insert() {
    $m = db();
    $truncate = 'TRUNCATE TABLE admin_val';
    $t = $m -> prepare($truncate);
    $t -> execute();
    $row = 0;
    if (($handle = fopen(__DIR__ . '/price/' . VAL, "r")) !== FALSE) {

        while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {

            if ($data[0] == '') {
                continue;
            }
            @$data[0] = preg_replace('/[^\d\:\.]/ui', '', $data[0]);
            $data[0] = date('Y-m-d H:i:s', strtotime($data[0]));
            $sql = "INSERT INTO admin_val (
              val_date,
              val_cost,
              val_profit,
              val_rent,
              val_manager,
              val_car
              ) VALUES (
              :val_date,
              :val_cost,
              :val_profit,
              :val_rent,
              :val_manager,
              :val_car
              )";

            $q = $m -> prepare($sql);
            $q -> execute(array(':val_date' => $data[0], ':val_cost' => $data[1], ':val_profit' => $data[2], ':val_rent' => $data[3], ':val_manager' => $data[4], ':val_car' => strtolower($data[5])));
            $row++;
            // p($data);
        }
        fclose($handle);
        print ' Вставлено ' . $row . ' строк';
    }
    return TRUE;
}

/*
 * Месячная прибыль вставка
 */
function val_insert_monthly() {
    $m = db();
    $truncate = 'TRUNCATE TABLE admin_val_month';
    $t = $m -> prepare($truncate);
    $t -> execute();
    $row = 0;
    if (($handle = fopen(__DIR__ . '/price/' . VALMONTH, "r")) !== FALSE) {

        while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
            //p($data);

            @$data[0] = preg_replace('/[^\d\:\.]/ui', '', $data[0]);
            // $data[0] = date('Y-m-d H:i:s', strtotime($data[0]));
            $sql = "INSERT INTO admin_val_month (
              val_date,
              val_cost,
              val_profit,
              val_rent,
              val_manager
              ) VALUES (
              :val_date,
              :val_cost,
              :val_profit,
              :val_rent,
              :val_manager
              )";

            $q = $m -> prepare($sql);
            $q -> execute(array(':val_date' => date("Y-m-d H:i:s", strtotime($data[0])), ':val_cost' => $data[1], ':val_profit' => $data[2], ':val_rent' => $data[3], ':val_manager' => $data[4]));
            $row++;

            //p($data);
        }
        fclose($handle);
        print ' Вставлено ' . $row . ' строк';
    }
    return TRUE;
}

/*
 * Instrt warehouse table
 */
function val_insert_warehouse() {
    $m = db();
    $query = 'SELECT ware_date FROM admin_warehouse WHERE ware_date = CURDATE()';
    $t = $m -> prepare($query);
    $good = $t -> execute();
    $c = $t -> rowCount();
    if ($c == 0) {
        $row = 0;
        if (($handle = fopen(__DIR__ . '/price/' . WAREHOUSE, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
                @$data[0] = preg_replace('/[^\d\:\.]/ui', '', $data[0]);
                // $data[0] = date('Y-m-d H:i:s', strtotime($data[0]));
                $sql = "INSERT INTO admin_warehouse (
              ware_date,
              ware_cost,
              ware_unit
              ) VALUES (
              :ware_date,
              :ware_cost,
              :ware_unit
              )";
                $q = $m -> prepare($sql);
                $q -> execute(array(':ware_date' => date("Y-m-d H:i:s", strtotime($data[0])), ':ware_cost' => $data[1], ':ware_unit' => $data[2]));
                $row++;
                //p($data);
            }
            fclose($handle);
            print ' Вставлено ' . $row . ' строк';
        }
    }//if
    else {

        $row = 0;
        if (($handle = fopen(__DIR__ . '/price/' . WAREHOUSE, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
                @$data[0] = preg_replace('/[^\d\:\.]/ui', '', $data[0]);
                // $data[0] = date('Y-m-d H:i:s', strtotime($data[0]));
                $sql = "UPDATE admin_warehouse SET
                          ware_cost = :ware_cost,
                          ware_unit =  :ware_unit
                          WHERE ware_date = CURDATE()";
                $q = $m -> prepare($sql);
                if($q -> execute(array(':ware_cost' => $data[1], ':ware_unit' => $data[2]))){
                        $row++;
                    echo 'Updated ' . $row .' rows';
                }

                //p($data);
            }
            fclose($handle);
            //return true;
        }
    }
}

function val_insert_car() {
    $m = db();
    truncate('admin_val_cars');
    $row = 0;
    $cars = val_cars();
    //p($cars);
    foreach ($cars as $car) {
        echo strtolower($car['engname']) . "<br>";
        if ((@$handle = fopen(__DIR__ . '/price/' . strtolower($car['engname']) . '.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
                @$data[0] = preg_replace('/[^\d\:\.]/ui', '', $data[0]);
                //$data[1] = date('Y-m-d H:i:s', strtotime($data[0]));

                $sql = "INSERT INTO admin_val_cars (
              date,
              cost,
              profit,
              rent,
              car
              ) VALUES (
              :date,
              :cost,
              :profit,
              :rent,
              :car
              )";
                $q = $m -> prepare($sql);
                $q -> execute(array(':date' => date("Y-m-d H:i:s", strtotime(@$data[0])), ':cost' => @$data[1], ':profit' => @$data[2], ':rent' => @$data[3], ':car' => strtolower($car['engname'])));
                $row++;
            }
            fclose($handle);
            print ' Вставлено ' . $row . ' строк';
        } else {
            continue;
            echo 'fuck you!';
        }
    }
    //return TRUE;
}

function val_cars() {
    $m = db();
    $q = "SELECT * FROM ang_cars";
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;

}

function truncate($table) {
    $m = db();
    $truncate = "TRUNCATE TABLE {$table}";
    $t = $m -> prepare($truncate);
    $t -> execute();
}

function val_insert_check() {
    $m = db();
    $query = 'SELECT date FROM admin_check WHERE DATE_FORMAT(date,"%Y-%m-%d") = DATE_FORMAT(NOW(), "%Y-%m-%d")';
    $t = $m -> prepare($query);
    $good = $t -> execute(array());
    $c = $t -> rowCount();
    if ($c == 0) {
        $row = 0;
        if (($handle = fopen(__DIR__ . '/price/' . CHECK, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
                @$data[0] = preg_replace('/[^\d\w]/ui', '', $data[0]);
                // $data[0] = date('Y-m-d H:i:s', strtotime($data[0]));
                $sql = "INSERT INTO admin_check (
              manager,
              avcheck
              ) VALUES (
              :manager,
              :avcheck
              )";
                $q = $m -> prepare($sql);
                $q -> execute(array(':manager' => $data[0], ':avcheck' => $data[1]));
                $row++;
            }
            fclose($handle);
            print ' Вставлено ' . $row . ' строк';
        }
    }//if
    else {
        echo 'fuck you!';
    }
    return TRUE;
}

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $eol = PHP_EOL;
    $file = $path . $filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
    $header .= "Reply-To: " . $replyto . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-type:text/plain; charset=utf-8\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n";
    $header .= $message . "\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n";
    // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n";
    $header .= $content . "\r\n";
    $header .= "--" . $uid . "--";
    $header = validateMail($header);
    foreach ($mailto as $mail_to) {
        if (mail($mail_to, $subject, "", $header)) {
            echo "mail send ... OK";
            // or use booleans here
        } else {
            echo "mail send ... ERROR!";
        }
    }
}

function validateMail($str) {
    return str_replace(array('\r\r', '\r\0', '\r\n\r\n', '\n\n', '\n\0'), '', $str);
}

function val_insert_car_motivation() {
    $m = db();
    truncate('adm_stuff_by_car');
    $row = 0;
    //p($cars);
        if ((@$handle = fopen(__DIR__ . '/price/car_stuff.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
               $data[0] = preg_replace('/[^\d\:\.]/ui', '', $data[0]);
                //$data[1] = date('Y-m-d H:i:s', strtotime($data[0]));
                //p($data);
                $sql = "INSERT INTO adm_stuff_by_car (
              date,
              cost,
              profit,
              car,
              manager
              ) VALUES (
              :date,
              :cost,
              :profit,
              :car,
              :manager
              )";
                $q = $m -> prepare($sql);
                $q -> execute(array(':date' => date("Y-m-d H:i:s", strtotime(@$data[0])), ':cost' => @$data[1], ':profit' => @$data[2], ':car' => strtolower($data[3]), ':manager'=>$data['5']));
                $row++;
            }
            fclose($handle);
            print ' Вставлено ' . $row . ' строк';
        } else {

            echo 'fuck you!';
        }

    //return TRUE;
}

//Вставляем количество продаж на каждого менеджера
function val_insert_sales_by_manager() {
  truncate('val_insert_sales_by_manager');
    $m = db();
        $row = 0;
        if (($handle = fopen(__DIR__ . '/price/' . 'sales.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
                //@$data[1] = preg_replace('/[^\d\w]/ui', '', $data[1]);
                //@$data[2] = preg_replace('/[^\d\w]/ui', '', $data[2]);
                $data[1] = round($data[1]);
                $data[2] = round($data[2]);
                //p($data);
                 $data[3] = date('Y-m-d H:i:s', strtotime($data[3]));
                $sql = "INSERT INTO val_insert_sales_by_manager
                (
                  manager,
                  document_cost,
                  document_profit,
                  date
              ) VALUES (
              :manager,
              :document_cost,
              :document_profit,
              :date
              )";
                $q = $m -> prepare($sql);
                $q -> execute(array(':manager' => $data[0], ':document_cost' =>$data[1], ':document_profit' => $data[2], ':date' => $data[3]));
                $row++;
            }
            fclose($handle);
            print ' Вставлено ' . $row . ' строк';
        }
    return TRUE;
}
