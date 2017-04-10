<?php
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "ashley";

    //$username = $_SESSION["username"];
    //$name     = $_SESSION["name"];

    $orders = array();
    /*
    if (isset($_GET["email"])) {
        $email = $_GET["email"];
    */
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
            
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT O.update_dt     AS order_date
                                        , P.brand_name    AS brand_name
                                        , P.product_name  AS product_name
                                        , O.qty           AS qty
                                        , P.price * O.qty AS price
                                    FROM orders O
                                    INNER JOIN products P
                                        ON O.product_id = P.product_id
                                    WHERE O.email = :email
                                    ORDER BY order_date"
                                    );
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            while($result = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($orders, $result);            
            }
            
            $stmt = null;
            $conn = null;

            echo json_encode($orders);

        } catch(PDOException $e) {
            echo $e->getMessage();
            //header("Location:503.html");
        }
    }
?>