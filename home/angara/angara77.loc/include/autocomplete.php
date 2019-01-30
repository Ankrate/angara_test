<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
//require_once ('include/bd.php');
//p($_GET);
if (isset($_GET['term'])) { $term = $_GET['term'];

}
$data_auto = get_autocomplete($term);
//p($data_auto);
foreach ($data_auto as $line) {
    $returnArr[] = array('value' => $line['1c_id'], 'label' => $line['ang_name']);
}
echo json_encode($returnArr);
