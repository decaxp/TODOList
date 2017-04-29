<?php
session_start();

include_once 'mysql.php';
include_once 'security.php';

function queryError($sql,$mysqli){
    // О нет! запрос не удался.
    echo "Извините, возникла проблема в работе сайта.";
    // И снова: не делайте этого на реальном сайте, но в этом примере мы покажем,
    // как получить информацию об ошибке:
    echo "Ошибка: Наш запрос не удался и вот почему: \n";
    echo "Запрос: " . $sql . "\n";
    echo "Номер_ошибки: " . $mysqli->errno . "\n";
    echo "Ошибка: " . $mysqli->error . "\n";
    exit;
}

$sqlGetTasks="select id,text,done,time from todolist where sessionID=? and id>?";


$host=$_SERVER['HTTP_HOST'];
//$id=test_input($_POST['id']);
$id=0;
$sessionID=session_id();


$stmt = $mysqli->prepare($sqlGetTasks);
$stmt->bind_param('ii', $sessionID,$id);
/* выполнение подготовленного запроса */
$stmt->execute();

$res = $stmt->get_result();
/* Выбрать значения */
$list=array();
$maxID=-1;
while ($row = $res->fetch_assoc()) {
    if (!is_null($row['text'])) {
        $list[] = [$row['text'], $row['done'],$row['time']];
        $maxID=$row['id'];
    }
}

echo json_encode($list,JSON_FORCE_OBJECT);
