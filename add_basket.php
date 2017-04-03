<?php
    $email      = $_POST["email"];
    $product_id = $_POST["product_id"];
    $qty        = $_POST["qty"];
    //INSERT INTO `ashley`.`MyBasket` (`email`, `product_id`, `qty`, `is_ordered`, `create_dt`, `update_dt`) VALUES ('abc@gmail.com', '00010001', '2', 'N', '20170403132000', '20170403132000');

    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "ashley";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO `ashley`.`MyBasket` (`email`, `product_id`, `qty`, `is_ordered`, `create_dt`, `update_dt`) 
                                VALUES (:email, :product_id, :qty, 'N', date_format(now(), '%Y%m%d%H%i%s'), date_format(now(), '%Y%m%d%H%i%s')");
        $stmt->bindParam(':email',      $email);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':qty',        $qty);
        
        $stmt->execute();
        
        $conn = null;     

    } catch(PDOException $e) {
        echo $e->getMessage();
        //echo "<script type='text/javascript'>alert('Error: " . $e->getMessage() . "');</script>";
        //header("Location:503.html");
    }

    // header("Location:contact.php");

?>