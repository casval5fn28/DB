<?php
session_start();
$dbservername = 'localhost';
$dbname = 'db';
$dbusername = 'admin';
$dbpassword = 'admin';

$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$missed = null;

function formatError(){
    $new_name = $_POST['new_name'];
    $new_price = $_POST['new_price'];
    $new_quantity = $_POST['new_quantity'];

    if (!preg_match("#^[a-zA-Z0-9_ .\-]+$#", $new_name)) {
        $GLOBALS['missed'] = "product_name";
        return true;
    }
    else if(!preg_match("/^(?:[1-9][0-9]*|0)$/",$new_price)){
        $GLOBALS['missed'] = "new_price";
        return true;
    }
    else if(!preg_match("/^(?:[1-9][0-9]*|0)$/",$new_quantity)){
        $GLOBALS['missed'] = "new_quantity";
        return true;
    }
    else{
        return false;
    }
}
try {
    if(!isset($_POST['new_price'])||!isset($_POST['new_quantity'])){
        header("Location: nav.php");
        exit();
    }
    else if(empty($_POST['new_name']) ||empty($_POST['new_price']) ||empty($_POST['new_amount'])){
        throw new Exception('Please input all the field!');
    }
    else if(formatError()){
        throw new Exception("Wrong format:".$GLOBALS['missed']);
    }

    $stmt = $conn->prepare("update product set  product_name=:product_name ,product_price=:product_price, 
                    product_amount=:product_amount where PID=:PID");
    $stmt->execute(array('product_name'=>$_POST['new_name'], 'product_price'=>$_POST['new_price'],
        'product_amount'=>$_POST['new_quantity']));
    echo <<<EOT
            <!DOCTYPE html>
            <html lang="en-us">
                <body>
                    <script>
                        alert("Start a business successfully.");
                        window.location.replace("../nav.php");
                    </script>
                </body>
            </html>
EOT;
    exit();
}
catch(Exception $e){

    $msg = $e->getMessage();
    echo <<<EOT
        <!DOCTYPE html>
        <html lang="en-us">
        <body>
        <script>
        alert("$msg");
        window.location.replace("nav.php");
        </script>
        </body>
        </html>
EOT;
}
?>
