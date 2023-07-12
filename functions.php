<?php
    function user_check($u_id){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo->prepare("SELECT * FROM users WHERE id=:id");
        $sql->bindParam(':id', $u_id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch();
        return $result;
    }

    function sign_in($u_name, $u_pass){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo->prepare("SELECT * FROM users WHERE name=:name");
        $sql->bindParam(':name', $u_name, PDO::PARAM_INT);
        $sql->execute();
        $results = $sql->fetchAll();
        foreach ($results as $row){
            if (password_verify($u_pass, $row['password'])){
                return $row;
            }
        }
        return "error";
    }

    function sign_up($u_name, $u_mail, $u_pass){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo -> prepare("INSERT INTO users (name, password, mail_address) VALUES (:name, :password, :mail_address)");
        $sql -> bindParam(':name', $u_name, PDO::PARAM_STR);
        $password = password_hash($u_pass, PASSWORD_DEFAULT);
        $sql -> bindParam(':password', $password, PDO::PARAM_STR);
        $sql -> bindParam(':mail_address', $u_mail, PDO::PARAM_STR);
        $sql -> execute();
    }

    function register($name, $maker, $ps, $pg, $memo, $cp, $iq, $sp){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo -> prepare("INSERT INTO products (name, maker, product_summary, product_genre, memo, cost_price, inventory_quantity, selling_price) VALUES (:name, :maker, :product_picture, :product_summary, :product_genre, :memo, :cost_price, :inventory_quantity, :selling_price)");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':maker', $maker, PDO::PARAM_STR);
        $sql -> bindParam(':product_summary', $ps, PDO::PARAM_STR);
        $sql -> bindParam(':product_genre', $pg, PDO::PARAM_STR);
        $sql -> bindParam(':memo', $memo, PDO::PARAM_STR);
        $sql -> bindParam(':cost_price', $cp, PDO::PARAM_STR);
        $sql -> bindParam(':inventory_quantity', $iq, PDO::PARAM_STR);
        $sql -> bindParam(':selling_price', $sp, PDO::PARAM_STR);
        $sql -> execute();  
    }

    function reregister($name, $maker, $ps, $pg, $memo, $cp, $iq, $sp){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo -> prepare("UPDATE products SET product_summary=:product_summary,product_genre=:product_genre,memo=:memo,cost_price=:cost_price,inventory_quantity=:inventory_quantity,selling_price=:selling_price WHERE name=:name AND maker=:maker");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':maker', $maker, PDO::PARAM_STR);
        $sql -> bindParam(':product_summary', $ps, PDO::PARAM_STR);
        $sql -> bindParam(':product_genre', $pg, PDO::PARAM_STR);
        $sql -> bindParam(':memo', $memo, PDO::PARAM_STR);
        $sql -> bindParam(':cost_price', $cp, PDO::PARAM_STR);
        $sql -> bindParam(':inventory_quantity', $iq, PDO::PARAM_STR);
        $sql -> bindParam(':selling_price', $sp, PDO::PARAM_STR);
        $sql -> execute();  
    }

    function change($name){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo->prepare("SELECT * FROM products WHERE name=:name");
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch();
        return $result;
    }
    function buystart($name){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo -> prepare("UPDATE products SET is_buy=:is_buy WHERE name=:name");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $one = 1;
        $sql -> bindParam(':is_buy', $one, PDO::PARAM_STR);
        $sql -> execute();

    }

    function buystop($name){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo -> prepare("UPDATE products SET is_buy=:is_buy WHERE name=:name");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $zero = 0;
        $sql -> bindParam(':is_buy', $zero, PDO::PARAM_STR);
        $sql -> execute();

    }

    function product_list(){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo->prepare("SELECT * FROM products");
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    function user_list(){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo->prepare("SELECT * FROM users");
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    function bill($name){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo->prepare("SELECT * FROM users WHERE name=:name");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch();

        $post_url = '***';
        $post_data = array(
            'name' => $result[1],
            'bill' => $result[6],
        );
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $post_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST => true, 
            CURLOPT_POSTFIELDS => json_encode($post_data),
        ]);
        $result = curl_exec($ch);
        curl_close($ch);

        $zero = 0;

        $sql = $pdo ->prepare("UPDATE users SET all_total=:all_total WHERE name=:name");
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':all_total', $zero, PDO::PARAM_INT);
        $sql->execute();
    }

    function buy($name, $id){
        $dsn = 'mysql:dbname=stores;host=localhost';
        $dbuser = 'rootusers';
        $dbpassword = 'password';
        $pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = $pdo->prepare("SELECT * FROM products WHERE name=:name");
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch();
        $now_inventory = $result[7] - 1;

        $sql = $pdo -> prepare("UPDATE products SET inventory_quantity=:inventory_quantity WHERE name=:name");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':inventory_quantity', $now_inventory, PDO::PARAM_INT);
        $sql -> execute();

        $sql = $pdo->prepare("SELECT * FROM users WHERE id=:id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $result2 = $sql->fetch();

        $sql = $pdo -> prepare("UPDATE users SET all_total=:all_total WHERE id=:id");
        $sql -> bindParam(':id', $id, PDO::PARAM_STR);
        $now_total = $result2[6] + $result[8];
        $sql -> bindParam(':all_total', $now_total, PDO::PARAM_INT);
        $sql -> execute();

        $objDateTime = new DateTime();
        $now_time = $objDateTime->format('Y-m-d');
        $one = 1;

        $sql = $pdo -> prepare("INSERT INTO buyproducts (user_id, user_name, date, product_name, product_cost_price	, product_selling_price, quantity) VALUES (:user_id, :user_name, :date, :product_name, :product_cost_price, :product_selling_price, :quantity)");
        $sql -> bindParam(':user_id', $result2[0], PDO::PARAM_INT);
        $sql -> bindParam(':user_name', $result2[1], PDO::PARAM_STR);
        $sql -> bindParam(':date', $now_time, PDO::PARAM_STR);
        $sql -> bindParam(':product_name', $result[0], PDO::PARAM_STR);
        $sql -> bindParam(':product_cost_price', $result[6], PDO::PARAM_INT);
        $sql -> bindParam(':product_selling_price', $result[8], PDO::PARAM_INT);
        $sql -> bindParam(':quantity', $one, PDO::PARAM_INT);
        $sql -> execute(); 
    }
?>