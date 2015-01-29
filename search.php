<?php

require_once 'medoo.php';
$db = new medoo();

$pattern = $_GET['pattern'];
$results = array();

$entries = $db->select('question', 'id', array('LIKE' =>
    array('OR' =>
    array('title' => $pattern, 'content' => $pattern))));
$qids = array();
foreach ($entries as $ind => $entry) {
    array_push($qids, $entry);
}

$entries = $db->select('answer', 'id', array('LIKE' =>
    array('content' => $pattern)));
$aids = array();
foreach ($entries as $ind => $entry) {
    array_push($aids, $entry['id']);
}

$entries = $db->select('comment', 'id', array('LIKE' =>
    array('content' => $pattern)));
$cids = array();
foreach ($entries as $ind => $entry) {
    array_push($cids, $entry['id']);
}

array_push($results, $qids);
array_push($results, $aids);
array_push($results, $cids);

echo json_encode($results);

?>