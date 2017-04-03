<?php
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "ashley";

    //$username = $_SESSION["username"];
    //$name     = $_SESSION["name"];

    $product_id = $_GET['product_id'];
    $products = array();

    if (isset($_GET['id'])) {
        echo "==================================================================================";
    }

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT product_id
                                     , brand_name
                                     , product_name
                                     , category
                                     , description
                                     , img_url
                                     , price
                                     , qty
                                     , update_dt
                                    FROM Products
                                   WHERE product_id = :product_id
                               ");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        while($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($products, $result);            
        }
        
        $stmt = null;
        $conn = null;

        echo json_encode($products);

    } catch(PDOException $e) {
        echo $e->getMessage();
        //header("Location:503.html");
    }
?>