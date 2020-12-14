<?php
    $username = 'dbuser';
    $password = 'dbpass';
    
    $database = new PDO('mysql:host=localhost;dbname=MyBBS;charset=UTF8;', $username, $password);
    
    if(array_key_exists('user', $_POST) && array_key_exists('content', $_POST)) {
        $sql = 'INSERT INTO bbs (user, content, created_at) VALUES(:user, :content, now())'; 
        $statement = $database->prepare($sql);
        $statement->bindParam(':user', $_POST['user']);
        $statement->bindParam(':content', $_POST['content']);
        $statement->execute();
        $statement->null;
    }
    
    // $sql = 'SELECT * FROM bbs ORDER BY created_at DESC';
    // $statement = $database -> query($sql);
    
    // $records = $statement->fetchall();
    
    // $statement = null;
    
    // $database = null;
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MyBBS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="MyBBS/style.css" type="text/css">
    </head>
    
    <body>
        <!--一覧表示機能-->
    <div class="container">
        <h1><a href="MyBBS.php">MyBBS</a></h1>
        <div>
                 
                 <?php require_once('page.php'); ?>
              
                
            </ul>
        </div>
       
       <!--投稿機能 -->
        <div>
            <form action="MyBBS.php" method="POST" >
                <h2>投稿者</h2>
                <div class="form-group">
                <input name="user" type="text" class="form-control" placeholder="投稿者名を入力" required>
                </div>
           
                <h2>本文</h2>
                <div class="form-group">
                <input name="content" type="textarea" class="form-control" placeholder="本文を入力"　required > 
                </div>
                
                <button type="submit" name="submit_add" class="btn btn-primary">投稿</button>
            </form>
        </div>
    </div>
        
        <!-- BootstrapなどのJavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>
    </body>
</html>