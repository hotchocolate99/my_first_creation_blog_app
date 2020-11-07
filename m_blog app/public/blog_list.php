<?php

require_once '../classes/database.php';
require_once '../classes/functions.php';

$blogData = getData();
//dbcle6.phpで定義した関数（データベースからデータを配列として取得）呼び出し。そしてそれを＄blogData変数に代入
                         //getDataメソッドの戻り値は$result.
?>
　　　　　　　　　　　　　
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>

</head>
<body>
      <h2>ブログ一覧</h2>
      <p><a href="form_le8.html">新規作成</a></p>
          <table>
             <tr>
                <th>タイトル</th>
                <th>カテゴリ</th>
                <th>投稿日</th>
             </tr>

            <?php foreach($blogData as $column):?>
             <tr>
               <td><?php echo h($column['title'])?></td>
               <td><?php echo h(setCateName($column['category']))?></td>
               <td><?php echo h($column['post_at'])?></td>
               <td><a href="detail.php?id=<?php echo h($column['id'])?>">詳細</a></td>  
               <!--①　覧画面に「詳細」と言うリンクを用意して、そこをクリックすると、
                詳細に飛ぶようにする。 「?id= 」は、クエリストリング？と言うらしい。
                php側でidの情報を受け取れるようになる。GETリクエストで送るのでこう書く。
                ＝の右側は上からコピペ。これで、詳細をクリックすると、idが渡される。-->
                
             </tr>
           <?php endforeach;?>
         </table>

</body>
</html>