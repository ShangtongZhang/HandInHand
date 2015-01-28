<?php

require_once 'medoo.php';
require_once 'question.php';
$db = new medoo();

if ($_GET['op'] == 'register') {
    $entry = json_decode($_GET['entry'], true);
    unset($entry['id']);
    echo $db->insert('user', $entry);
} elseif ($_GET['op'] == 'update') {
    $entry = json_decode($_GET['entry'], true);
    echo ($db->update('user', $entry, array('id' => $entry['id'])));
} elseif ($_GET['op'] == 'count') {
    echo $db->count('user', array('username' => $_GET['username']));
} elseif ($_GET['op'] == 'authenticate') {
    var_dump($_GET);
    echo $db->count('user',
        array('AND' =>
            array('username' => $_GET['username'],
                'password' => $_GET['password'])));
} elseif ($_GET['op'] == 'get') {
    $data = $db->select('user', '*', array('username' => $_GET['username']));
    echo json_encode($data[0]);
} elseif ($_GET['op'] == 'countQuestions') {
    echo $db->count('question', array('uid' => $_GET['uid']));
} elseif ($_GET['op'] == 'getQuestions') {
    $qids = $db->select('question', array('id'), array('uid' => $_GET['uid'],
        'ORDER' => 'createdTime DESC'));
    $entries = array();
    foreach ($qids as $ind => $qid) {
        array_push($entries, getByQid($qid['id']));
    }
    echo json_encode($entries);
} elseif ($_GET['op'] == 'countAnswers') {
    echo $db->count('answer', array('uid' => $_GET['uid']));
} elseif ($_GET['op'] == 'getAnswers') {
    $entries = $db->select('answer', '*', array('uid' => $_GET['uid'],
        'ORDER => createdTime'));
    echo json_encode($entries);
}

?>