<!DOCTYPE html>
<?php

function get_categories(){
    $m = db();
    $query = 'SELECT *
    FROM salesscript_categories
    ORDER BY category_name';
    $sth = $m -> prepare($query);
     $sth -> execute(array(0));
    $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function db() {
    $ANG_HOST = 'localhost';
    $ANG_DBNAME ='test';
    $ANG_DBUSER = 'root';
    $ANG_DBPASS = 'manhee33338';
    try {
        $dsn = 'mysql:dbname=' . $ANG_DBNAME . ';host=' . $ANG_HOST;
        $pdo = new PDO($dsn, $ANG_DBUSER, $ANG_DBPASS);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo -> exec("set names utf8");
    } catch(PDOException $e) {
        echo $e -> getMessage();
    }
    return $pdo;
}

function p($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
?>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>Скрипт продаж компании Ангара</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>

    <body>
        <?php include "header.php"?>
        <div class="wrapper">
            <div class="middle">
                <div class="div_top">
                    <p class="p1">Редактирование категорий <i class="fa fa-pencil"></i></p>
                    <div class="categories">
                        <div class="categories_wrap">
                            <?php 
                            $data = get_categories();
                            $data_count = count($data);
                            for ($i=0; $i < $data_count; $i++){
                                $name_old = "'" . $data[$i]['category_name'] . "'";    
                                $id_to_rename = /*"'" .*/ $data[$i]['id'] /*. "'"*/;    
                                echo '<div class="category_row" id="category_row_id_' . $id_to_rename . '">';
                                echo '<input id="input_rename_' . $id_to_rename .'" class="input input_category" value="' .$data[$i]['category_name'] . '">';
                                echo '</input>';                                
                                echo '<button class="button_categories button_neutral" onclick="ajax_rename(' . $id_to_rename  . ',' . $name_old . ')">Переименовать</button>';
                                echo '<button class="button_categories button_delete" onclick="ajax_delete(' . $id_to_rename  . ')">Удалить</button>';
                                echo '</div>';
                            }
                                echo '<div style="margin-top:40px;"></div>';
                                echo '<div class="category_row">';
                                echo '<form action="db.php" method="post" class="form_horizontal">';
                                echo '<input id="new_category" name="add_category_php"  class="input input_category" placeholder="Новая категория" value="' .$data[$i]['category_name'] . '" required></input>';
                                echo '<button type="submit" class="button_categories button_ok" onclick="" >Добавить</button>';
                                echo '<form>';
                                echo '</div>';         
                                ?>
                        </div>
                    </div>
                </div>
                <div class="div_bottom_wrap">
                </div>
            </div>
        </div>
        <?php include "footer.php"?>
    </body>
    
    <script>
        var slide_speed = 100;
        $(document).ready(function() {
            var value_public = '';
            var for_model = '';
        });
        
        function set_element(id, id_parent, text_question, text_answer) {
            console.log(id + " " + id_parent + " " + text_question + " " + text_answer);
            $('#textarea_edit_question').text(text_question);
            $('#textarea_edit_answer').text(text_answer);
            $('#select_parent_edit').val(id_parent);
        }        

        function ajax_rename(id,old_name) {
            alert('Название изменено');
            var new_name = $('#input_rename_'+id).val();
            console.log('id: ' + id + ' new_name: '+ new_name);
            
            $.ajax({
                type: "POST",
                url: "ajax_functions.php",
                data: {
                    action: 'rename_category',
                    id_to_rename: id,
                    new_name: new_name,
                    old_name: old_name
                }
            }).done(function(result) {
              //  console.log("Result rename: " + result);
            });
        }
        
        function ajax_add() {
            var new_category = $('#new_category').val();
            console.log('add: ' + new_category);            
            $.ajax({
                type: "POST",
                url: "ajax_functions.php",
                data: {
                    action: 'add_category',
                    new_category: new_category
                }
            }).done(function(result) {
               // console.log("Result add: " + result);
            });
        }
        
        function ajax_delete(id_to_delete) {
            $("#category_row_id_"+id_to_delete).slideUp(slide_speed);
           // console.log('delete: ' + id_to_delete);            
            $.ajax({
                type: "POST",
                url: "ajax_functions.php",
                data: {
                    action: 'delete_category',
                    id_to_delete: id_to_delete,
                }
            }).done(function(result) {
              //  console.log("Result add: " + result);
            });
        }
    </script>

    </html>