<?php

require_once 'medoo.php';

$configFile = fopen('config', 'r');
$jsonStr = fread($configFile, filesize('config'));
$config = json_decode($jsonStr);
$fileNo = $config->fileNo;
$config->fileNo = $fileNo + 1;
fclose($configFile);
$configFile = fopen('config', 'w');
fwrite($configFile, json_encode($config));
fclose($config);

$fileName = $fileNo . '_' . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], './upload/' . $fileName);

echo $fileName;

?>