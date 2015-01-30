<?php

require_once 'medoo.php';
$db = new medoo();

switch ($_GET['op']) {
    case 'send':
        $entry = json_decode($_GET['entry'], true);
        unset($entry['id']);
        echo $db->insert('message', $entry);
        break;
    case 'getSentMsgs':
        $entries = $db->select('message', '*', array('sender' => $_GET['uid'],
            'ORDER' => 'createdTime DESC'));
        echo json_encode($entries);
        break;
    case 'getAllReceivedMsgs':
        $entries = $db->select('message', '*', array('receiver' => $_GET['uid'],
            'ORDER' => 'createdTime DESC'));
        echo json_encode($entries);
        break;
    case 'getUnhandledMsgs':
        $entries = $db->select('message', '*', array('AND' =>
            array('receiver' => $_GET['uid'],
            'status' => 0), 'ORDER' => 'createdTime DESC'));
        echo json_encode($entries);
        break;
}

?>