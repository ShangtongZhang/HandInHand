<?php

require_once 'medoo.php';
$db = new medoo();

function getByQid($qid) {
    $db = new medoo();
    $question = $db->select('question', '*', array('id' => $qid));
    $question = $question[0];
    $topics = $db->select('question_topic', array('tid'),
            array('qid' => $question['id']));
    $tids = array();
    foreach ($topics as $ind => $topic) {
        array_push($tids, $topic['tid']);
    }
    $question['topics'] = $tids;
    return $question;
}

if ($_GET['op'] == 'add') {
    $entry = json_decode($_GET['entry'], true);
    $topics = $entry['topics'];
    unset($entry['id']);
    unset($entry['topics']);
    $qid = $db->insert('question', $entry);
    foreach ($topics as $ind => $tid) {
        $db->insert('question_topic', array('qid' => $qid,
            'tid' => $tid));
    }
    echo $qid;
} elseif ($_GET['op'] == 'update') {
    $entry = json_decode($_GET['entry'], true);
    $topics = $entry['topics'];
    $db->delete('question_topic', array('qid' => $entry['id']));
    foreach ($topics as $ind => $tid) {
        $db->insert('question_topic', array('qid' => $entry['id'],
            'tid' => $tid));
    }
    unset($entry['topics']);
    echo $db->update('question', $entry, array('id' => $entry['id']));
} elseif ($_GET['op'] == 'delete') {
    echo $db->delete('question', array('id' => $_GET['qid']));
} elseif ($_GET['op'] == 'getByTopic') {
    $qids = $db->select('question', array('[>]question_topic' =>
        array('id' => 'qid')), array('question.id'),
        array('question_topic.tid' => $_GET['tid'],
            'ORDER' => 'createdTime DESC'));
    $questions = array();
    foreach ($qids as $ind => $qid) {
        array_push($questions, getByQid($qid['id']));
    }
    echo json_encode($questions);
} elseif ($_GET['op'] == 'getByQid') {
    echo json_encode(getByQid($_GET['qid']));
}

?>