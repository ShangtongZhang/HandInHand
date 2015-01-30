<?php

require_once 'medoo.php';
require_once 'util.php';
$db = new medoo();

if ($_GET['op'] == 'showQuestionStatus') {
    echo showStatus($db, 'favorite_question', 'uid', 'qid');
} elseif ($_GET['op'] == 'showAnswerStatus') {
    echo showStatus($db, 'favorite_answer', 'uid', 'aid');
} elseif ($_GET['op'] == 'showUserStatus') {
    echo showStatus($db, 'favorite_user', 'uid', 'uid2');
} elseif ($_GET['op'] == 'toggleAnswer') {
    echo toggleAnEntry($db, 'favorite_answer', 'uid', 'aid');
} elseif ($_GET['op'] == 'toggleQuestion') {
    echo toggleAnEntry($db, 'favorite_question', 'uid', 'qid');
} elseif ($_GET['op'] == 'toggleUser') {
    echo toggleAnEntry($db, 'favorite_user', 'uid', 'uid2');
}elseif ($_GET['op'] == 'listQuestions') {
    echo listEntries($db, 'favorite_question', 'uid', 'qid');
} elseif ($_GET['op'] == 'listAnswers') {
    echo listEntries($db, 'favorite_answer', 'uid', 'aid');
} elseif ($_GET['op'] == 'listUsers') {
    echo listEntries($db, 'favorite_user', 'uid', 'uid2');
}

?>