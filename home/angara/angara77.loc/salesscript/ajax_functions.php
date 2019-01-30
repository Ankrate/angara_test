<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if($_POST['action'] == 'rename_category') {
    $id_to_rename = $_POST['id_to_rename'];
    $to_rename = $_POST['old_name'];
    $new_name = $_POST['new_name'];
    rename_category($id_to_rename,$new_name);
    $result = $id_to_rename  . ' ' . $to_rename . "->" . $new_name;
  echo $result ;
}

if($_POST['action'] == 'add_category') {
    $new_category = $_POST['new_category'];
    add_category($new_category);
    $result = $new_category;
  echo $result ;
}

if($_POST['action'] == 'delete_category') {
    $id_to_delete = $_POST['id_to_delete'];
    delete_category($id_to_delete);
    $result = 'delete +';
  echo $result ;
}

if($_POST['action'] == 'delete_association') {
    $id_to_delete = $_POST['id_to_delete'];
     $first = $_POST['first'];
     $second = $_POST['second'];
    delete_association($first,$second);
    $result = $new_category;
  echo $result ;
}

if($_POST['action'] == 'delete_model') {
    $id_to_delete = $_POST['id_to_delete'];
    delete_model($id_to_delete);
    $result = "del";
  echo $result ;
}

if($_POST['action'] == 'delete_situation') {
    $category_name = $_POST['category_name'];
    $id_category_array = get_category_id($_POST['category_name']);
    $id_category = $id_category_array['0']['id'];
    $text_question = $_POST['text_question'];
    $text_answer = $_POST['text_answer'];
    $model = $_POST['model'];
    delete_situation($id_category, $category_name, $text_question, $text_answer, $model);
    $result = " ! " . $id_category . ' ' . $category_name . ' ' . $text_question .  ' ' . $text_answer .  ' ' . $model ;
  echo $result ;
}

if($_POST['action'] == 'edit_situation') {
    $category_name = $_POST['category_name'];
    $id_category_array = get_category_id($_POST['category_name']);
    $id_category = $id_category_array['0']['id'];
    $text_question = $_POST['text_question'];
    $text_question_new = $_POST['text_question_new'];
    $text_answer = $_POST['text_answer'];
    $text_answer_new = $_POST['text_answer_new'];
    $model = $_POST['model'];
    $model_new = $_POST['model_new'];
    $result = "edit ! " . $id_category . ' ' . $category_name . ' ' . $text_question .  ' ' . $text_question_new .  ' ' . $text_answer .  ' ' . $text_answer_new .  ' ' . $model . ' ' . $model_new ;
    edit_situation($id_category, $category_name, $text_question, $text_question_new, $text_answer, $text_answer_new, $model, $model_new);
  echo $result ;
}

if($_POST['action'] == 'get_associations_query') {
    $to_search = $_POST['to_search'];
    $data = get_associations_query($to_search);
    $result = rawurlencode(json_encode($data));
  echo $result ;
}

if($_POST['action'] == 'get_synonyms_query') {
    $to_search = $_POST['to_search'];
    $data = get_synonyms_query($to_search);
    $result = rawurlencode(json_encode($data));
  echo $result ;
}

if($_POST['action'] == 'get_situations_query') {
    $to_search = $_POST['to_search'];
    $to_model = $_POST['to_model'];
    $data = get_situations_query($to_search, $to_model);
    $result = rawurlencode(json_encode($data));
  echo $result ;
}

function rename_category($id_to_rename,$new_name){
    $m = db();
    $query = 'UPDATE salesscript_categories SET category_name="' . $new_name . '" WHERE id="' . $id_to_rename .  '" ';
    $sth = $m -> prepare($query);
    $sth -> execute(array($id_to_rename));
    $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function add_category ($category_name) {
     $m = db();
     $query = 'INSERT INTO salesscript_categories (category_name) VALUES ("' . $category_name .'")';
     $sth = $m -> prepare($query);
     $sth -> execute(array($category_name));
     $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     return $data;
}

function get_category_id($category_name){
    $m = db();
    $query = 'SELECT * FROM salesscript_categories WHERE category_name="' . $category_name . '"' ;
    $sth = $m -> prepare($query);
    $sth -> execute(array(0));
    $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function delete_category ($id_to_delete) {
    delete_category_from_categories ($id_to_delete);
    delete_category_from_associations ($id_to_delete);
    delete_category_from_synonyms ($id_to_delete);
    //from situations
}

function delete_category_from_categories ($id_to_delete) {
     $m = db();
     $query = 'DELETE FROM salesscript_categories WHERE id= ? ';
     $sth = $m -> prepare($query);

     $sth -> execute(array($id_to_delete));
     //$data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     //return $data;
}
function delete_category_from_associations ($id_to_delete) {
     $m = db();
     $query = 'DELETE FROM salesscript_associations WHERE id= ?'  ;
     $sth = $m -> prepare($query);
     $sth -> execute(array($id_to_delete));
     //$data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     //return $data;
}
function delete_category_from_synonyms ($id_to_delete) {
     $m = db();
     $query = 'DELETE FROM salesscript_synonyms WHERE id= :id'  ;
     $sth = $m -> prepare($query);
     $sth -> execute(array(':id' => $id_to_delete));
     //$data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     //return $data;
}

function delete_association($first, $second) {
     $m = db();
     $query = 'DELETE FROM salesscript_associations WHERE id="' . $first . '" AND id_second="' . $second . '"';
     $sth = $m -> prepare($query);
     $sth -> execute(array($category_name));
     $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     return $data;
}

function delete_model($id_to_delete) {
     $m = db();
     $query = 'DELETE FROM salesscript_models WHERE i=' . $id_to_delete  ;
     $sth = $m -> prepare($query);
     $sth -> execute(array($category_name));
     $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     return $data;
}

function delete_situation($id_category, $category_name, $text_question, $text_answer, $model) {
     $m = db();
     $query = 'DELETE FROM salesscript_situations WHERE id_category=' . $id_category . ' AND text_question="' . $text_question . '" AND text_answer="' . $text_answer . '" AND model="' . $model . '"'  ;
     $sth = $m -> prepare($query);
     $sth -> execute(array($category_name));
     $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     return $data;
}

function edit_situation($id_category, $category_name, $text_question, $text_question_new, $text_answer, $text_answer_new, $model, $model_new) {
     $m = db();
     $query = 'UPDATE salesscript_situations SET text_question="' . $text_question_new . '", text_answer="' . $text_answer_new .  '", model="' . $model_new .  '" WHERE id_category=' . $id_category . ' AND text_question="' . $text_question . '" AND text_answer="' . $text_answer . '" AND model="' . $model . '"'  ;
     $sth = $m -> prepare($query);
     $sth -> execute(array($category_name));
     $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     return $data;
}

function get_associations_query($to_search) {
     $m = db();
     $query = 'SELECT * FROM salesscript_associations WHERE category_name LIKE "%' . $to_search . '%"  OR category_second LIKE "%' . $to_search . '%" '  ;
     $sth = $m -> prepare($query);
     $sth -> execute(array($category_name));
     $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     return $data;
}

function get_synonyms_query($to_search) {
     $m = db();
     $query = 'SELECT * FROM salesscript_synonyms WHERE category_name LIKE "%' . $to_search . '%"  OR synonym LIKE "%' . $to_search . '%" '  ;
     $sth = $m -> prepare($query);
     $sth -> execute(array($category_name));
     $data = $sth -> fetchAll(PDO::FETCH_ASSOC);
     return $data;
}

function get_situations_query($to_search, $to_model) {
     $m = db();
     $query = 'SELECT * FROM salesscript_situations WHERE category_name LIKE "%' . $to_search . '%"'; //  OR synonym LIKE "%' . $to_search . '%" '  ;
     $sth = $m -> prepare($query);
     $sth -> execute(array($category_name));
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
