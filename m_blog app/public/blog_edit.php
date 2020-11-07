<?php
//session_start();

ini_set('display_errors',true);
require_once '../classes/database.php';
require_once '../classes/functions.php';

//home.phpから＄GETでidを受け取った。
$id = $_GET['id'];

$result = getById($id,'posts','ブログはありません。');

$id = $result['id'];
//＄id　を　「$_GET['id']」　から　「$result['id']」　に更新することで、インプットタイプのhiddenに
//乗せて、記事の更新や削除の過程へ移行する。
$title = $result['title'];
$content = $result['content'];
$category = (int)$result['category'];
//result['category']は文字列なので、$categoryに数字として代入するために（int）を付ける。
$publish_status = $result['publish_status'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事編集</title>
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
        <h2 class="form_title">記事編集フォーム</h2>
        

        <form action="blog_update.php" method="POST" class="formspace">
　　　　　　　<input type="hidden" name="id" value="<?php echo h($id) ?>">

           <div class="form_item"><p>タイトル</p></div>
           <input type="text" class="form_text" name="title" value="<?php echo h($title)?>">

          <div class="form_item"><p>ブログ本文</p></div>
          <textarea name="content" id="content" cols="100" rows="20"><?php echo h($content)?></textarea>
          <br>

          <div class="form_item"><p>カテゴリ</p></div>
          <select name="category">
             <option value="0" <?php if($category === 0){ echo 'selected'; }?> >その他</option>
             <option value="1" <?php if($category === 1){ echo 'selected'; }?> >日記</option>
             <option value="2" <?php if($category === 2){ echo 'selected'; }?> >独自のカテゴリー</option>
             
          </select>
          <br>

          <div class="form_item"></div>
          <input type="radio" name="publish_status" value="1" <?php if($publish_status === 1){ echo 'checked'; }?> >公開
          <input type="radio" name="publish_status" value="2" <?php if($publish_status === 2){ echo 'checked'; }?> >非公開
          <br>

          <input type="submit" value="更新" class="btn">
          
        </form>
        </div>

            </div>

</div>
    </div> 

<footer>

</footer>

</body>
</html>