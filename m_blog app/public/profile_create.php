<?php
require_once '../classes/database.php';

ini_set('display_errors',true);


$profile = $_POST;
//var_dump($blogs);

if(empty($profile['nick_name'])){
    exit('ニックネームを入力してください。');
}

if(mb_strlen($profile['intro_text'])>191){
    exit('自己紹介文は191字以下にして下さい。');
}


$dbh = dbConnect();
$dbh->beginTransaction();

$sql = 'INSERT INTO profiles(nick_name, intro_text)
        VALUES(:nick_name, :intro_text)';

try{
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':nick_name', $profile['nick_name'],PDO::PARAM_STR);
    $stmt->bindValue(':intro_text', $profile['intro_text'],PDO::PARAM_STR);

    $stmt->execute();
    $dbh->commit();
    echo '自己紹介文を投稿しました。';

}catch(PDOException $e){
    $dbh->rollBack();
    exit($e);
}

?>