<?php
session_start();

ini_set('display_errors',true);
require_once '../classes/database.php';
require_once '../classes/functions.php';

$id = $_GET['id'];

$result = getById($id,'posts');
//テーブル名はクォーテーション付けなくても大丈夫だった。
$_SESSION = $result;
header('Location:home.php#selected_topic');
//var_dump($SESSION);
//↑ちゃんと配列になって入っている。



