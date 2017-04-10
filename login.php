<?php
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "ashley";

    //$username = $_SESSION["username"];
    //$name     = $_SESSION["name"];
    $email = "";
    $password = "";

    $row = array();
    $result = array();
    

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
  
    /*  
    if (isset($_GET['email']) && isset($_GET['password'])) {
        $email = $_GET['email'];
        $password = $_GET['password'];
    */
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
            
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT email
                                         , password
                                         , first_name
                                         , last_name
                                      FROM users
                                     WHERE email = :email
                                ");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            if ($result == false) {
                $result = array();
                $code   = array("result"=>"E001");
            } else if ($result->password != $password) {
                $result = array();
                $code   = array("result"=>"E002");
            } else if ($result->email == $email && $result->password == $password) {
                $result = json_decode(json_encode($result), True);
                $code = array('result' => 'S001');
            }
            $result += $code;
            
            $stmt = null;
            $conn = null;

        } catch(PDOException $e) {
            $result = array();
            $code   = array("result"=>"E010");
            $result += $code;
        }
    } else {
        $result = array();
        $code   = array("result"=>"E009");
        $result += $code;
    }
    array_push($row, $result);
    echo json_encode($row);

?>