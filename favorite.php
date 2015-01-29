<?php

require_once 'medoo.php';
$db = new medoo();
if ($_GET['op'] == 'showQuestionStatus') {
    echo $db->count('favorite_question', array('AND' =>
        array('uid' => $_GET['uid'],
            'qid' => $_GET['qid'])));
} elseif ($_GET['op'] == 'showAnswerStatus') {
    echo $db->count('favorite_answer', array('AND' =>
        array('uid' => $_GET['uid'],
            'aid' => $_GET['aid'])));
} elseif ($_GET['op'] == 'toggleAnswer') {
    $curState = $db->count('favorite_answer', array('AND' =>
        array('uid' => $_GET['uid'],
            'aid' => $_GET['aid'])));
    if ($curState == 0) {
        $db->insert('favorite_answer', array('uid' => $_GET['uid'],
            'aid' => $_GET['aid']));
        echo 1;
    } else {
        $db->delete('favorite_answer', array('AND' =>
        array('uid' => $_GET['uid'],
            'aid' => $_GET['aid'])));
        echo 0;
    }
} elseif ($_GET['op'] == 'toggleQuestion') {
    $curState = $db->count('favorite_question', array('AND' =>
        array('uid' => $_GET['uid'],
            'qid' => $_GET['qid'])));
    if ($curState == 0) {
        $db->insert('favorite_question', array('uid' => $_GET['uid'],
            'qid' => $_GET['qid']));
        echo 1;
    } else {
        $db->delete('favorite_question', array('AND' =>
            array('uid' => $_GET['uid'],
                'qid' => $_GET['qid'])));
        echo 0;
    }
} elseif ($_GET['op'] == 'listQuestions') {
    $entries = $db->select('favorite_question', '*', array('uid' => $_GET['uid']));
    $qids = array();
    foreach ($entries as $ind => $entry) {
        array_push($qids, $entry['qid']);
    }
    echo json_encode($qids);
} elseif ($_GET['op'] == 'listAnswers') {
    $entries = $db->select('favorite_answer', '*', array('uid' => $_GET['uid']));
    $aids = array();
    foreach ($entries as $ind => $entry) {
        array_push($aids, $entry['aid']);
    }
    echo json_encode($aids);
}

?>