<?php
session_start();
$result = $_SESSION;
//var_dump($result);

////if(!$result){
  //exit('ブログはありません。');
//}
 $_SESSION = array();
session_destroy();

require_once '../classes/database.php';
require_once '../classes/functions.php';
//ini_set('display_errors',true);
$blogData = getData();
//var_dump($blogData);

//↑の＄blogDataから、選択された$column['id']を取得するのが出来なかったので、一旦、それをdetail.phpにGETで送った。。。
//それをSESSIONに入れて、またこのhome.phpに戻し、詳細を表示するようにした。
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../classes/home.css">
    <link rel="stylesheet" href="../classes/header.css">
</head>

<body>

<?php include 'header.php';?>




  <div class="container">
     <div class="main">
            <div class="left">
            
                   <div class="list_posts">
                           <h2>記事一覧</h2>

                            <table>
                              <tr>
                                  <th>タイトル</th>
                                  <th>投稿日</th> 
                              </tr>

                              <?php foreach($blogData as $column):?>
                              <tr>
                                <td><?php echo h($column['title'])?></td>
                                <td class=date><?php echo h($column['post_at'])?></td>

                                <td class="detail"><a class="sml_btn" href="detail.php?id=<?php echo h($column['id'])?>">詳細</a></td>

                              </tr>
                              <?php endforeach;?>
                              </table>
                  </div><!--list_posts-->

                    <div class="selected_topic"><a name="selected_topic"></a>
                              <?php if(!$result):?>
                                <p><?php echo '上から詳細を表示したい記事を選んでください。'; ?></p>
                              <?php endif;?>

                              <?php if($result):?>
                                 <h2 class="title"><?php echo h($result['title']);?></h2>
                                 <p class="date_posted">投稿日：<?php echo h($result['post_at']);?></p>
                                 <p>カテゴリ：<?php echo h(setCateName($result['category']));?></p>
                                 <p class="blog_content"><?php echo h($result['content'])?></p>

                                 <img class="img" src="" alt="blog_image" /><br>

                               <a class="sml_btn" href="blog_edit.php?id=<?php echo h($result['id'])?>">記事の編集</a>
                               <a class="sml_btn" href="blog_delete.php?id=<?php echo h($result['id'])?>">記事の削除</a>

                              <?php endif;?>
                              <div class="to_top"><a href="#">トップへ戻る</a></div><br>
                     </div>

            </div><!--left-->



            <div class="right">
                　　<div class="profile">
                    　　<img class="img" src="" alt="profile_image" />
                    　　<h2>ユーザーニックネーム</h2>
                    　　<p>ユーザー自己紹介文</p>
                　　</div>

                　　
                　　　<div class="comment_info">
                    　
                        <div class="container">
                          <div class="main">
                          　  <div class="input">
                                  <h2 class="form_title"><span><i class="fas fa-comment"></i>コメントフォーム</span></h2>

                                  <form action="blog_comment.php" method="POST"　class="formspace">
                                    <p class="form_item">名前</p>
                                    <input type="text" class="form_text" name="c_name">

                                    <p class="form_item">メールアドレス</p>
                                    <input type="text" class="form_text" name="c_email">


                                    <div class="form_item"><p>コメント</p></div>
                                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
                                    <br>

                                    <input type="submit" value="投稿" class="btn_s">
                                  </form>

                              </div><!--input-->
                          </div><!--main-->
                      </div><!--container-->
                   </div><!--comment_info-->



                　　　
            </div><!--right-->
        </div><!--main-->
  </div> <!--container-->

<footer>

</footer>

</body>
</html>