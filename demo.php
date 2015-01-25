<?php

require_once 'medoo.php';

$db = new medoo();

//$db->insert("tag", array("id" => 7,"tag" => $_GET['tag']));
$entries = json_decode($_GET['entries']);
$db->insert("tag", $entries);
$res = $db->select("tag", '*');

echo json_encode($res);

?>