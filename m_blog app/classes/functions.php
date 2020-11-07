<?php
require_once '../classes/database.php';


//idとテーブル名を引数にして、DBからデータを取得
   function getById($id,$table){
    if(empty($id)){
        exit('不正なIDです。');
    }

    $dbh = dbConnect();
    $stmt = $dbh->prepare("SELECT * FROM $table WHERE id = :id");
    //注意すること！！！　sql文内で変数を展開する時はダブルクォーテーションにする！！シングルだと、変数展開できない。
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    //GET で送られてきたidは文字列として入ってくるので、（int）をここにつけることで、int型になる。そして数字として認識させる。なぜその必要があるのか？？？
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result){
       exit($error_comment);
    }

    return $result;

}


//XSS対策エスケープ
 function h($s){
     return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
 }



//ブログのバリデーション　返り値はなしでOK？？？
  function blogValidate($blogs){

      if(empty($blogs['title'])){
          exit('タイトルを入力してください。');
      }

      if(mb_strlen($blogs['title'])>26){
          exit('タイトルは25字以下にして下さい。');
      }

      if(empty($blogs['content'])){
          exit('本文を入力して下さい。');
      }

      if(empty($blogs['category'])){
          exit('カテゴリーは必須です。');
      }

      if(empty($blogs['publish_status'])){
          exit('公開ステータスは必須です。');
      }
  }

//下の二つのメソッドにDBとテーブルも引数に加えた方が良い？？　ユーザーインターフェイスを意識
//ブログ新規投稿
 function blogCreate($blogs){

    $sql = "INSERT INTO posts(title, content, category, publish_status)
            VALUES(:title, :content, :category, :publish_status)";


    $dbh = dbConnect();
    $dbh->beginTransaction();


    try{
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $blogs['title'],PDO::PARAM_STR);
        $stmt->bindValue(':content', $blogs['content'],PDO::PARAM_STR);
        $stmt->bindValue(':category', $blogs['category'],PDO::PARAM_INT);
        $stmt->bindValue(':publish_status', $blogs['publish_status'],PDO::PARAM_INT);

        $stmt->execute();
        $dbh->commit();
        //echo 'ブログを投稿しました。';

    }catch(PDOException $e){
        $dbh->rollBack();
        exit($e);
    }


  }



//ブログの更新
  function blogUpdate($blogs){

    $sql = "UPDATE posts SET
                   title = :title, content = :content, category = :category, publish_status = :publish_status

            WHERE id = :id;";

    //insertの時もprepareいるの？？これってDBからデータを取得するのに使うんじゃないの？？ちなみに　「$sql = 'SELECT * FROM blog';」
    //だからデータをDBから取り出してるよね？？

    $dbh = dbConnect();
    $dbh->beginTransaction();

    try{
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':title', $blogs['title'],PDO::PARAM_STR);
        $stmt->bindValue(':content', $blogs['content'],PDO::PARAM_STR);
        $stmt->bindValue(':category', $blogs['category'],PDO::PARAM_INT);
        $stmt->bindValue(':publish_status', $blogs['publish_status'],PDO::PARAM_INT);
        $stmt->bindValue(':id', $blogs['id'],PDO::PARAM_INT);


        $stmt->execute();
        $dbh->commit();
        //echo 'ブログを更新しました。';

    }catch(PDOException $e){
        $dbh->rollBack();
        exit($e);
    }

  }

  //カテゴリーを数字表記からちゃんとした文字表現に変更
  function setCateName($cate){
    if($cate ===0){
        return '指定なし';
    }

    if($cate=== 1){
        return '日記';
    }

    if($cate === 2){
        return '独自のカテゴリ';
    }

    if($cate === 3){
        return 'その他';
    }
  }

//ブログ削除　返り値なしでOK??
  function delete($id,$table){
     if(empty($id)){
         exit('不正なIDです。');
     }

    $dbh = dbConnect();
    $stmt = $dbh->prepare("DELETE FROM $table WHERE id = :id");
    //注意すること！！！　sql文内で変数を展開する時はダブルクォーテーションにする！！シングルだと、変数展開できない。
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    //GET で送られてきたidは文字列として入ってくるので、（int）をここにつけることで、int型になる。そして数字として認識させる。なぜその必要があるのか？？？
    $stmt->execute();
    //echo '記事は削除されました。';
    
  }
  