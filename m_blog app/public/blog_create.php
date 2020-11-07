
<?php


ini_set('display_errors',true);


require_once '../classes/database.php';
require_once '../classes/functions.php';

$blogs = $_POST;
//var_dump($blogs);

blogValidate($blogs);

blogCreate($blogs);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿完了</title>
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
                      <p class="form_title">投稿を完了しました。</p>

                      <div class="to_home"><a href="home.php">HOMEへ戻る</a></div><br>
                 </div>
            </div>
        </div>

<footer>
</footer>


</body>
</html>




