<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/sample/images/favicon.ico" />
    <title>大吉商店 | トップページ</title>
</head>
<body>
    <?php
        include('./functions.php');
        if(!empty($_POST["ch_id"]) || !empty($_POST["signup"]) || !empty($_POST["signin"])){
            if(!empty($_POST["buy"]) && !empty($_POST["product"])){
                buy($_POST["product"], $_POST["ch_id"]);
            }
        }

        if(!empty($_POST["ch_id"])){
            $info = user_check($_POST["ch_id"]);
            $ch_id = $info[0];
            echo 'ユーザ名：'.  $info[1] . '<br>';
            echo 'メールアドレス：'.  $info[3] . '<br>';
            echo '購入分未支払い残高：'.  $info[6] . '<br>';
            echo "<hr>";
        }else if(!empty($_POST["signup"])){
            sign_up($_POST["name"], $_POST["mailaddress"], $_POST["password"]);
            $info = sign_in($_POST["name"], $_POST["password"]);
            if ($info != "error"){
                $ch_id = $info[0];
                echo 'ユーザ名：'.  $info[1] . '<br>';
                echo 'メールアドレス：'.  $info[3] . '<br>';
                echo '購入分未支払い残高：'.  $info[6] . '<br>';
                echo "<hr>";
            }else{
                echo 'もう一度サインイン・サインアップしてください'.'<br>';
            }
        }else if(!empty($_POST["signin"])){
            $info = sign_in($_POST["name_in"], $_POST["password_in"]);
            if ($info != "error"){
                if ($info[4] == 1){
                    header('Location:admin.php?id='.$info[0]);
                    exit;
                }else{
                    $ch_id = $info[0];
                    echo 'ユーザ名：'.  $info[1] . '<br>';
                    echo 'メールアドレス：'.  $info[3] . '<br>';
                    echo '購入分未支払い残高：'.  $info[6] . '<br>';
                    echo "<hr>";
                }
            }else{
                echo 'もう一度サインイン・サインアップしてください'.'<br>';
            }
        }else{
            echo 'サインイン・サインアップしてください'.'<br>';
            echo "<hr>";
        }
    ?>

    <h3>サインインはこちらから</h3>
    <form action="" method="post">
        <input type="text" name="name_in" placeholder="ユーザ名" required>
        <input type="text" name="password_in" placeholder="パスワード" required>
        <input type="submit" name="signin" value="サインイン"></br>
    </form>
    <hr>

    <h3>サインアップはこちらから</h3>
    <form action="" method="post">
        <input type="text" name="name" placeholder="ユーザ名" required>
        <input type="text" name="mailaddress" placeholder="メールアドレス" required>
        <input type="text" name="password" placeholder="パスワード" required>
        <input type="submit" name="signup" value="サインアップ"></br>
    </form>
    <hr>

    <h3>商品ラインナップ</h3>
    <form action="" method="post">
        <input type="hidden" name="ch_id" value="<?php if(isset($ch_id)){echo $ch_id;}?>">
        <input type="text" name="product" placeholder="商品名" required>    
        <input type="submit" name="buy" value="購入"></br>
    </form>
    <hr>
    <?php
        $count = 1;
        if(!empty($_POST["ch_id"]) || !empty($_POST["signup"]) || !empty($_POST["signin"])){
            $resultproducts = product_list();
            foreach ($resultproducts as $resultproduct){
                if ($resultproduct[9] == 1){
                    echo "<".  $count.">，商品名：".  $resultproduct[0]. "，メーカー：".$resultproduct[1]. "，ジャンル：".$resultproduct[4]. "，販売価格：".$resultproduct[8]. "，在庫数：".$resultproduct[7];
                    echo "<br>";
                    echo "商品概要：".  $resultproduct[3];
                    echo "<br>";
                    echo "備考：".$resultproduct[5];
                    echo "<br>";
                    echo "<hr>";
                    $count = $count + 1;
                }
            }
        }
    ?>
</body>
</html>