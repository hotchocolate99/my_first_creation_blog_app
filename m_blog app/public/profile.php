<?php

ini_set('display_errors',true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
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
        <h2 class="form_title">プロフィールフォーム</h2>

        <form action="profile_create.php" method="POST" class="formspace">
           <p class="form_item">ニックネーム</p>
           <input type="text" class="form_text" name="nick_name">

          <div class="form_item"><p>自己紹介</p></div>
          <textarea name="intro_text" id="content" cols="50" rows="10"></textarea>
          <br>

          <input type="submit" value="決定" class="btn">
          
        </form>
        </div>

            </div>

</div>
    </div> 

<footer>

</footer>

</body>
</html>