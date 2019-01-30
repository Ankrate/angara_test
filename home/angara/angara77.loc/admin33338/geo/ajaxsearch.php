<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
function get_ajax_search(){
    $m = db();
    $q =   'SELECT * FROM search_query order by `query_date` desc LIMIT 20';
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}


$show = get_ajax_search();
foreach($show as $s){
    $n[] = array('id'=>$s['id'], 'search_q' => preg_replace('/(\/\d+)+/ui', ' ', $s['search_q']), 'query_date' => date('d.M H:i',strtotime($s['query_date'])), 'query_ip' => $s['query_ip']);
}
//p($n);
echo json_encode($n);
//p($show);

