<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
function get_ajax_search(){
    $m = db();
    $q =   'SELECT  *, COUNT( * ) 
            FROM  `search_query`
            WHERE query_date > DATE_FORMAT( CURRENT_DATE - INTERVAL 1 
            MONTH ,  "%Y/%m/01" ) 
            GROUP BY  `search_q` 
            ORDER BY COUNT( * ) DESC 
            LIMIT 20';
    $t = $m -> prepare($q);
    $t -> execute();
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data;
}


$show = get_ajax_search();
foreach($show as $s){
    $n[] = array('id'=>$s['id'], 'search_q' => preg_replace('/(\/\d+)+/ui', ' ', $s['search_q']), 'query_date' => date('d.M H:i',strtotime($s['query_date'])), 'query_ip' => $s['query_ip'], 'count' => $s['COUNT( * )']);
}
//p($n);
echo json_encode($n);
//p($show);

