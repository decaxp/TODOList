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
$sqlInsertTask="insert into todolist (sessionID,text) values (?,?)";

$host=$_SERVER['HTTP_HOST'];
$newtask=test_input($_POST['newtask']);

$sessionID=session_id();

if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//добавляем task

$stmt = $mysqli->prepare($sqlInsertTask);
$stmt->bind_param('is', $sessionID,ltrim(rtrim($newtask)));
/* выполнение подготовленного запроса */
$stmt->execute();

$stmt->close();
