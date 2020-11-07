<?php
require_once '../classes/database.php';
require_once '../classes/functions.php';

//ini_set('display_errors',true);

function getSearchWord($search_word){
    $dbh = dbConnect();

    if($search_word !== ""){
        $sql = "SELECT * FROM posts WHERE title LIKE '%".$search_word."%' OR content LIKE '%".$search_word."%' OR post_at LIKE '%".$search_word."%'";
               //全角スペースを半角スペースに変えましたが、それでもまだ同じエラーが出ます。。。
        $stmt = $dbh->query($sql);

        $result = $stmt->fetchall(PDO::FETCH_ASSOC);

        return $results;
        $dbh = null;
    }
}

$search_word = $_POST['search_word'];
//var_dump($search_word);
$results = getSearchWord($search_word);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事検索の結果</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../classes/home.css">
    <link rel="stylesheet" href="../classes/header.css">
</head>
<body>

<?php include 'header.php';?>

<div class="container">
    <div class="main">
    　<div class="input">
        <h2 class="form_title">記事の検索結果</h2>

           <ul>
           <?php foreach($results as $result):?>
                 <li><?php echo $result?></li>
           <?php endforeach;?>
           </ul>
           <div class="to_home"><a href="home.php">HOMEへ戻る</a></div><br>
      </div>
    </div>
</div>

<footer>

</footer>

</body>
</html>

<!--$sql = 'SELECT * FROM posts WHERE title OR content OR post_at LIKE '%'.(int)$word.'%'';


<h2 class="form_title">記事の検索結果</h2>

           <ul>
              <li><?php echo h($results['title']) ?></li>
              <li><?php echo h($results['content']) ?></li>
              <li><?php echo h($results['post_at']) ?></li>
           </ul>
-->