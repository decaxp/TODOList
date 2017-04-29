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

$sqlDeleteTask="delete from todolist where id=?";

$host=$_SERVER['HTTP_HOST'];
$id=test_input($_POST['id']);

$sessionID=session_id();


$stmt = $mysqli->prepare($sqlDeleteTask);
$stmt->bind_param('i',$id);
/* выполнение подготовленного запроса */
$stmt->execute();

echo 1;