<?php

require_once 'medoo.php';
$db = new medoo();

if ($_GET['op'] == 'add') {
    $entry = json_decode($_GET['entry'], true);
    unset($entry['id']);
    echo $db->insert('answer', $entry);
} elseif ($_GET['op'] == 'delete') {
    echo $db->delete('answer', array('id' => $_GET['aid']));
} elseif ($_GET['op'] == 'update') {
    $entry = json_decode($_GET['entry'], true);
    echo $db->update('answer', $entry, array('id' => $entry['id']));
} elseif ($_GET['op'] == 'getByQid') {
    $entries = $db->select('answer', '*', array('qid' => $_GET['qid'],
        'ORDER' => 'createdTime DESC'));
    echo json_encode($entries);
} elseif ($_GET['op'] == 'getByAid') {
    $entries = $db->select('answer', '*', array('id' => $_GET['aid']));
    echo json_encode($entries);
}

?>