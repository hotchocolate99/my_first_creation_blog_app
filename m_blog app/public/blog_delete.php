<?php
//session_start();

ini_set('display_errors',true);
require_once '../classes/database.php';
require_once '../classes/functions.php';

$id = $_GET['id'];

$result = delete($id,'posts');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除メッセージ</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../classes/stylesheet.css">
    <link rel="stylesheet" href="../classes/header.css">
    <link rel="stylesheet" href="../classes/form.css">
</head>

<body>

<?php include 'header.php';?>

    <div class="container">
        <div class="main">
        　  <div class="input">
              <p class="form_title">記事は削除されました。</p>

              <div class="to_home"><a href="home.php">HOMEへ戻る</a></div><br>

            </div>
        </div>
     </div>
     

<footer>

</footer>

</body>
</html>