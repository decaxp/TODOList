<?php

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


//begin автоматическое удаление 

$deleteDoneTask="delete from todolist where DATE_FORMAT(todolist.updated,'%H') - DATE_FORMAT(todolist.time,'%H')>=1 and done=1";
$stmt = $mysqli->query($deleteDoneTask);

/* выполнение подготовленного запроса */




//end



$sqlGetTasks="select id,text,done,time from todolist where sessionID=? and id>? order by time asc";


$host=$_SERVER['HTTP_HOST'];
$id=test_input($_POST['id']);
$sessionID=test_input($_POST['sid']);


$selectCountTask="select count(id) as count from todolist where sessionID=? and id>?";

$stmt = $mysqli->prepare($selectCountTask);
$stmt->bind_param('si', $sessionID,$id);
/* выполнение подготовленного запроса */
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if ($count==0){
	echo 0;
	exit();
}



$stmt = $mysqli->prepare($sqlGetTasks);
$stmt->bind_param('si', $sessionID,$id);
/* выполнение подготовленного запроса */
$stmt->execute();

$res = $stmt->get_result();
/* Выбрать значения */
$list=array();
$maxID=-1;
while ($row = $res->fetch_assoc()) {
    if (!is_null($row['text'])) {
        $list[] = [$row['text'], $row['done'],$row['time'],$row['id']];
        $maxID=$row['id'];
    }
}

echo json_encode($list,JSON_FORCE_OBJECT);
