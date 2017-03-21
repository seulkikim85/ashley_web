<?php
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "ashley";

    //$username = $_SESSION["username"];
    //$name     = $_SESSION["name"];

    $category = "001";
    $products = array();

    if (isset($_GET['id'])) {
        echo "==================================================================================";
    }

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT P.product_id
                                     , P.brand_name
                                     , P.product_name
                                     , P.category
                                     , P.description
                                     , P.img_url
                                     , P.price
                                     , P.qty - IFNULL(O.qty, 0) as qty
                                     , CASE P.qty - O.qty WHEN 0 THEN 'Y'
                                       ELSE 'N'
                                       END  as is_soldout
                                     , P.update_dt
                                    FROM Products P
                                    LEFT JOIN 
                                    (SELECT product_id
                                          , sum(qty) as qty
                                       FROM Orders
                                      GROUP BY product_id) O
                                      ON P.product_id = O.product_id
                                   WHERE category = :category
                                   ORDER BY P.update_dt DESC"
                               );
        $stmt->bindParam(':category', $category);
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