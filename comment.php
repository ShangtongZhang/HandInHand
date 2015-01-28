<?php
require_once 'medoo.php';
$db = new medoo();

if ($_GET['op'] == 'add') {
    $entry = json_decode($_GET['entry'], true);
    unset($entry['id']);
    echo $db->insert('comment', $entry);
} elseif ($_GET['op'] == 'delete') {
    echo $db->delete('comment', array('id' => $_GET['cid']));
} elseif ($_GET['op'] == 'update') {
    $entry = json_decode($_GET['entry'], true);
    echo $db->update('comment', $entry, array('id' => $entry['id']));
} elseif ($_GET['op'] == 'getByAid') {
    $entries = $db->select('comment', '*', array('aid' => $_GET['aid'],
        'ORDER' => 'createdTime'));
    echo json_encode($entries);
}
?>