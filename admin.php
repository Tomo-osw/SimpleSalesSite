<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/sample/images/favicon.ico" />
    <title>大吉商店 | 管理ページ</title>
</head>
<body>

<?php
    $ch_id = $_GET['id'];
    include('./functions.php');
    $info = user_check($ch_id);
    if ($info[4] != 1){
        header('Location:index.php');
        exit;
    }else{
        echo 'ID：'.  $info[0] . '<br>';
        echo 'ユーザ名：'.  $info[1] . '<br>';
        echo 'メールアドレス：'.  $info[3] . '<br>';
        echo "<hr>";
    }
?>

<h3>商品登録・修正</h3>
<?php
    if(!empty($_POST["register"])){
        if(!empty($_POST["change_check"])){
            reregister($_POST["name"], $_POST["maker"], $_POST["ps"], $_POST["pg"], $_POST["memo"], $_POST["cp"], $_POST["iq"], $_POST["sp"]);
            echo '商品修正を実施しました';
        }else{
            register($_POST["name"], $_POST["maker"],$_POST["ps"], $_POST["pg"], $_POST["memo"], $_POST["cp"], $_POST["iq"], $_POST["sp"]);
            echo '商品登録を実施しました';
        }
    }else if(!empty($_POST["change"])){
        $change_result = change($_POST["name"]);
        $ch_name = $change_result[0];
    }
?>

<!--<img src="data:image/jpeg;base64,<?php echo $img;?>"><br>-->

<form action="" method="post">
        <input type="text" name="name" placeholder="商品名">
        <input type="text" name="maker" placeholder="メーカー"></br>
        <input type="text" name="ps" placeholder="商品概要" >
        <input type="text" name="pg" placeholder="商品ジャンル" >
        <input type="text" name="memo" placeholder="備考">
        <input type="text" name="cp" placeholder="仕入れ値" >
        <input type="text" name="iq" placeholder="在庫数" >
        <input type="text" name="sp" placeholder="販売価格"></br>
        <input type="text" name="change_check" placeholder="修正用" value="<?php if(isset($ch_name)){echo $ch_name;}?>">
        <input type="submit" name="register" value="商品登録・修正">
        <input type="submit" name="change" value="変更"></br>
</form>
<p>※商品登録・修正：備考を除き、全て埋めたうえで商品登録・修正ボタンを押してください</p>
<p>※変更：商品名のみ入力の上、変更ボタンを押してください</p>
<hr>

<h3>販売開始・販売停止</h3>
<?php
    if(!empty($_POST["buyname"])){
        if(!empty($_POST["buystart"])){
            buystart($_POST["buyname"]);
            echo $_POST["buyname"].'を、販売開始しました';
        }else if(!empty($_POST["buystop"])){
            buystop($_POST["buyname"]);
            echo $_POST["buyname"].'を、販売停止しました';
        }
    }
?>
<form action="" method="post">
    <input type="text" name="buyname" placeholder="商品名" required>
    <input type="submit" name="buystart" value="販売開始">
    <input type="submit" name="buystop" value="販売停止"></br>
</form>
<hr>

<h3>商品一覧・在庫数確認</h3>
<?php
    $resultproducts = product_list();
    foreach ($resultproducts as $resultproduct){
        echo "商品名：".  $resultproduct[0]. "，在庫数：".$resultproduct[7]. "，販売価格：".$resultproduct[8]. "，販売中：".$resultproduct[9];
        echo "<br>";
    }
    echo "<br>";
?>
<hr>

<h3>請求書発行</h3>
<p>ユーザ名・未支払い残高一覧</p>
<?php
    if(!empty($_POST["gasstart"]) && !empty($_POST["gasname"])){
        bill($_POST["gasname"]);
        echo $_POST["gasname"].'に対して、請求書発行を実施しました';
    }

    $resultusers = user_list();
    foreach ($resultusers as $resultuser){
        echo "ユーザ名：".  $resultuser[1]. "，未支払い残高：".$resultuser[6];
        echo "<br>";
    }
    echo "<br>";
?>
<form action="" method="post">
    <input type="text" name="gasname" placeholder="ユーザ名" required>
    <input type="submit" name="gasstart" value="請求書発行"></br>
</form>
<hr>

</body>
</html>