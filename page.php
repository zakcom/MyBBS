<?php
    // １ページに表示する記事の数
    define('max_view',5);
    
    //データベース に接続
    
    try{
       $database = new PDO('mysql:host=localhost;dbname=MyBBS;charset=UTF8;', $username, $password);

    } catch (PDOException $error) {
        //エラーの場合はエラーメッセージを吐き出す
        exit("データベースに接続できませんでした。<br>" . $error->getMessage());
    }
    
    // 必要なページ数を求める
    $count = $database->prepare('SELECT COUNT(*) AS count FROM bbs');
    $count->execute();
    $total_count = $count->fetch(PDO::FETCH_ASSOC);
    $pages = ceil($total_count['count'] / max_view);
    
    //現在いるページ番号を取得
    if(!isset($_GET['page_id'])){
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
    
    //表示する記事を取得するSQLを準備
    $select = $database->prepare("SELECT * FROM bbs ORDER BY id  DESC LIMIT :start, :max ");
    if($now == 1){
        //１ページ目の処理
        $select->bindValue(":start",$now -1,PDO::PARAM_INT);
        $select->bindValue(":max",max_view,PDO::PARAM_INT);
    }else{
        //１ページ以外の処理
        $select->bindValue(":start", ($now -1) * max_view,PDO::PARAM_INT);
        $select->bindValue(":max",max_view,PDO::PARAM_INT);
    }
        //実行し結果を取り出す
        $select->execute();
        $data = $select->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html la="ja">
    <head>
        <meta　charset="UTF-8">
        <title>ページネーション</title>
    </head>
    <body>

         <h2>投稿一覧</h2>
            <ul class="list-unstyled">
                 <?php
                    if($data){
                        foreach($data as $row){
                            $user = $row['user'];
                            $content = $row['content'];
                            $date = $row['created_at']
                            
                ?>
                           <div class="d-flex justify-content-start">
                               <li class="media mr-3"><?php print htmlspecialchars($user, ENT_QUOTES, "UTF-8");?></li>
                               <li class="text-muted"><?php print htmlspecialchars($date)?></li>
                            </div>
                               <li class="media border-bottom border-dark mb-3"><?php print htmlspecialchars($content, ENT_QUOTES, "UTF-8");?></li>
                <?php
                        }
                        
                    }
                 ?>
         <?php
            //ページネーションを表示
            for ( $n = 1; $n <= $pages; $n ++){
                if ( $n == $now ){
                    echo "<span style='padding: 5px;'>$now</span>";
                }else{
                    echo "<a href='./MyBBS.php?page_id=$n' style='padding: 5px;'>$n</a>";
                }
            }
        ?>
    </body>
</html>